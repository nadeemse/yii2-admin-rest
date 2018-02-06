<?php

namespace backend\controllers;

use app\models\MediaManagerSearch;
use Yii;

use yii\web\Controller;
use common\helpers\Utf8Helper;
use app\models\MediaManager;

/**
 * BannerController implements the CRUD actions for Banners model.
 * @author Nadeem Akhtar <nadeem@myswich.com>
 */
class FileManagerController extends Controller
{
    /**
     * Init function that will init the parent
     * @return null
     * */
    public function init()
    {
        parent::init();
    }


    public function prepareData() {

        $params = Yii::$app->request->queryParams;

        $searchModel = new MediaManagerSearch();
        $dataProvider = $searchModel->search($params);

        $data['parent'] = 0;
        $data['target'] = null;
        $data['thumb'] = null;

        if (isset($params['parent_id']) && (int)$params['parent_id'] > 0) {
            $parent = MediaManager::findOne($params['parent_id']);

            if ($parent !== null && $parent->parent_id > 0) {
                $data['parent'] = $parent->parent_id;
            } else {
                $data['parent'] = 0;
            }
        }

        if (Yii::$app->request->get('target')) {
            $data['target'] = Yii::$app->request->get('target');
        }

        if (Yii::$app->request->get('thumb')) {
            $data['thumb'] = Yii::$app->request->get('thumb');
        }

        /**
         * View Data
         */

        $viewData = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data
        ];

        return $viewData;
    }



    /**
     * List of images & directories
     * @return string
     */
    public function actionIndex()
    {
        /**
         * If request is ajax then return partial
         */
        $viewData = $this->prepareData();
        return $this->renderPartial('modal-box', $viewData);
    }

    /**
     * Manager
     * */
    public function actionManager() {

        $viewData = $this->prepareData();
        return $this->render('index', $viewData);
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */

    public function actionUpload()
    {
        $json = [];

        // Make sure we have the correct directory
        if (Yii::$app->request->get('parent_id')) {
            $currentDir = MediaManager::findOne(Yii::$app->request->get('parent_id'));
            $parent_id = $currentDir->id;
            $path = $currentDir->path . '/';
        } else {
            $directory = null;
            $parent_id = 0;
            $path = '';
        }


        if (!$json) {
            $file = \yii\web\UploadedFile::getInstanceByName('file');

            if (!empty($file->name)) {
                // Sanitize the filename
                $filename = basename(html_entity_decode($file->name, ENT_QUOTES, 'UTF-8'));
                $extension = $file->extension;
                $name = $file->baseName;

                // Validate the filename length
                if ((Utf8Helper::utf8_strlen($filename) < 3) || (Utf8Helper::utf8_strlen($filename) > 255)) {
                    $json['error'] = Yii::$app->params['error_filename'];
                }

                // Allowed file extension types
                $allowed = [
                    'jpg',
                    'jpeg',
                    'gif',
                    'png'
                ];

                if (!in_array(Utf8Helper::utf8_strtolower(Utf8Helper::utf8_substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = Yii::$app->params['error_filetype'];
                }

                // Allowed file mime types
                $allowed = [
                    'image/jpeg',
                    'image/pjpeg',
                    'image/png',
                    'image/x-png',
                    'image/gif'
                ];

                if (!in_array($file->type, $allowed)) {
                    $json['error'] = Yii::$app->params['error_filetype'];
                }

                // Return any upload error
                if ($file->error != UPLOAD_ERR_OK) {
                    $json['error'] = Yii::$app->params['error_upload' . $file->error];
                }
            } else {
                $json['error'] = Yii::$app->params['error_upload'];
            }
        }

        if (!$json) {
            $uniqueName = trim((str_replace(' ', '', $name) . uniqid()));

            $randomName = $string = preg_replace('/\s+/', '', $uniqueName) . '.' . $extension;

            $uploadObject = Yii::$app->get('s3bucket')->upload($path . $randomName, $file->tempName);

            if ($uploadObject) {
                // check if CDN host is available then upload and get cdn URL.
                $url = Yii::$app->get('s3bucket')->getUrl($path . $randomName);
                /*if (Yii::$app->get('s3bucket')->cdnHostname) {
                    $url = Yii::$app->get('s3bucket')->getCdnUrl($path . $randomName);
                } else {
                    $url = Yii::$app->get('s3bucket')->getUrl();
                }*/

                // Save Data into Database
                $data = ['name' => $file->name, 'parent_id' => $parent_id, 'type' => 'file', 'href' => $url, 'path' => $path . $randomName ];
                $this->saveObject($data);
                $json['success'] = Yii::$app->params['text_uploaded'];
            } else {
                $json['error'] = Yii::$app->params['error_upload'];
            }
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $json;
    }

    /**
     * Create a new folder function
     * This will create a new folder
     * @return array of folder & files from index function
     * */
    public function actionFolder()
    {

        $json = [];

        // Make sure we have the correct directory
        $parent_id = 0;
        if (Yii::$app->request->get('parent_id')) {
            $parent_id = Yii::$app->request->get('parent_id');
        }


        // Sanitize the folder name
        $folder = str_replace(['../', '..\\', '..'], '', basename(html_entity_decode(Yii::$app->request->post('folder'), ENT_QUOTES, 'UTF-8')));

        // Validate the filename length
        if ((Utf8Helper::utf8_strlen($folder) < 3) || (Utf8Helper::utf8_strlen($folder) > 128)) {
            $json['error'] = Yii::$app->params['error_folder'];
        }

        $isExist = MediaManager::find()->where(['parent_id' => $parent_id, 'name' => $folder])->one();

        // Check if directory already exists or not
        if ($isExist !== null) {
            $json['error'] = Yii::$app->params['error_exists'];
        }

        if (!$json) {
            $parent = MediaManager::findOne($parent_id);

            $path = $folder;
            if ($parent !== null) {
                $path = $parent->path . '/' . $folder;
            }

            // Save Data into Database
            $data = ['name' => $folder, 'parent_id' => $parent_id, 'type' => 'folder', 'path' => $path];
            $this->saveObject($data);

            $json['success'] = Yii::$app->params['text_directory'];
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $json;
    }

    /**
     * Delete file from folder
     * @return success | Error
     *
     * */
    public function actionDelete()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $json = [];

        if (Yii::$app->request->post('path')) {
            $paths = Yii::$app->request->post('path');
        } else {
            $paths = [];
        }


        if (!$json) {
            // Loop through each path
            foreach ($paths as $path) {
                $mediaObject = MediaManager::findOne($path);

                /**
                 * If path is just a file delete it also delete it from AWS
                 * */
                if ($mediaObject->type == 'file') {
                    Yii::$app->get('s3bucket')->delete($mediaObject->path);
                    $fileObj = $mediaObject->delete();

                    if (!$fileObj) {
                        return $fileObj->getErrors();
                    }
                } elseif ($mediaObject->type == 'folder') {
                    Yii::$app->get('s3bucket')->delete($mediaObject->path);
                    $mediaObject->deleteRecursive(['files', 'folders']);
                }
            }

            $json['success'] = Yii::$app->params['text_delete'];
        }

        return $json;
    }

    /**
     * Get All Folders
     * @param mixed $condition this is the array with attributes & value
     * @return mixed of folder & files
     * */
    public function getFolder($condition)
    {

        if (!empty($condition)) {
            $folderInfo = MediaManager::find()->with('files', 'folders')->where($condition)->one();

            if ($folderInfo !== null) {
                return $folderInfo;
            }
        }

        return [];
    }

    /**
     * Get All Folders
     * @param string $type this is string that will used to conditionlized
     * @return mixed of folder & files
     * */
    public function getRootFoldersFiles($type)
    {

        $folderInfo = null;

        if ($type == 'folder') {
            $folderInfo = MediaManager::find()->where(['type' => 'folder', 'parent_id' => '0'])->all();
        } elseif ($type == 'file') {
            $folderInfo = MediaManager::find()->where(['type' => 'file', 'parent_id' => '0'])->all();
        }

        return $folderInfo;
    }

    /**
     * Save Object Onformaiton
     * @param array $data of object
     * @return boolean tru or false
     * */
    public function saveObject($data)
    {

        $folderObj = new MediaManager();
        $folderObj->attributes = $data;
        $folderObj->created_at = Yii::$app->dateTime->getTime();

        return $folderObj->save();
    }
}
