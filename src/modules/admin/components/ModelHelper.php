<?php 

namespace app\modules\admin\components;


use app\models\Audio;
use app\models\Settings;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ModelHelper extends Component {

     public static function saveImage($model, $attribute = 'image', $isMain = true){
          //remove main model image
          $file = UploadedFile::getInstance($model, $attribute);

          if(!$file){
               return false;
          }

          if($model->getImageByName($attribute)) {
               $model->removeImage($model->getImageByName($attribute));
          }


          $path = \Yii::getAlias('@webroot').'/files/' . $file->baseName . '-'.date('dmYHs').'.' . $file->extension;
          $file->saveAs($path);
          return $model->attachImage($path, $isMain, $attribute);
     }

     public static function saveGallery($model, $attribute = 'gallery'){
          //remove all model images except main
          $files = UploadedFile::getInstances($model, $attribute);
          if(!$files) {
               return false;
          }

          $main_image = $model->getImage();
          if($main_image) {
               foreach ($model->getImages() as $image) {
                    if ($main_image->id != $image->id) {
                         $model->removeImage($image);
                    }
               }
          }

          foreach($files as $file) {
               $path = \Yii::getAlias('@webroot').'/files/' . $file->baseName . '-'.date('dmYHs').'.' . $file->extension;
               $file->saveAs($path);
               $model->attachImage($path);
          }
          return true;
     }

     public static function setCollection($collection = 'countries', $arr_item) {
          $model = Settings::findOne(['slug'=>$collection]);
          if(!$model){
               $model = new Settings();
               $model->slug = $collection;
               $model->save();
          }
          $content_arr = explode(',', $model->content);
          $arr_item = explode(',', $arr_item);
          foreach($arr_item as $item){
              $item = trim($item);
              if(!preg_grep( "/".$item."/i" , $content_arr ) && $item){
                   $content_arr[] = $item;
              }
          }

          $model->content = implode(',', $content_arr);
          return $model->save();
     }

     public static function getCollection($collection = 'countries') {
          $model = Settings::findOne(['slug'=>$collection]);

          return $model ? explode(',', $model->content) : '';
     }

     public static function parseVideo($links = []){
          return implode(',', $links);
     }

     public static function parseAudio($audios = [], $model, $attribute = 'audios'){
          $files = UploadedFile::getInstances($model, $attribute);

          foreach($files as $k => $file) {
               $date = date('dmYHs');
               $path = \Yii::getAlias('@webroot').'/files/' . $file->baseName . '-'.$date.'.' . $file->extension;
               $file->saveAs($path);
               
               $audio = new Audio();
               $audio->artist_id = $model->id;
               $audio->name = $audios[$k]['name'];
               $audio->path = '/files/' . $file->baseName . '-'.$date.'.' . $file->extension;
               $audio->save();
          }
          return true;
     }

     protected function parseYoutubeUrl($url) {
          $video_id = false;
          if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
               $video_id = $match[1];
          }

          return $video_id;
     }

     protected function getYoutubeVideoTitle($id) {
          $content = @file_get_contents("http://youtube.com/get_video_info?video_id=".$id);
          parse_str($content, $ytarr);
          return !empty($ytarr['title']) ? $ytarr['title'] : '';
     }

     public static function formatVideo($dirtyLinks = '') {
          $links = explode(',', $dirtyLinks);
          $out = [];

          foreach ($links as $link){
               $id = self::parseYoutubeUrl($link);
               $out[] =[
                   'image'=>'http://img.youtube.com/vi/'.$id.'/mqdefault.jpg',
                    'title' => self::getYoutubeVideoTitle($id),
                    'url' => $link,
               ];
          }

          return $out;
     }

     public static function formatSingleVideo($src){
          $id = self::parseYoutubeUrl($src);

          return 'http://img.youtube.com/vi/'.$id.'/mqdefault.jpg';
     }
}



