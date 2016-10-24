<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Brush\Accounts\Developer;
use \Brush\Accounts\Account;
use \Brush\Accounts\Credentials;
use \Brush\Pastes\Draft;
use \Brush\Pastes\Options\Visibility;
use \Brush\Exceptions\BrushException;

class APIController extends Controller {
    //
    public function getPhotos(Request $request) {
        //let's grab all the photos from the public directory
        $images = glob(public_path() . '/images/'.'*.JPG');
        $imageArray = [];
        foreach($images as $img) {
            //let's build a more friendly file object 
            $imgInfo = pathinfo($img);
            $imageObj = (object)[];

            $imageObj->dirname  = $imgInfo['dirname'];
            $imageObj->basename = 'images/' . $imgInfo['basename'];
            $imageObj->filename = ucfirst($imgInfo['filename']);
            $imageObj->filesize = filesize($img) . ' bytes';
            $imageArray[] = $imageObj;
        }

        return response()->json(["images" => $imageArray]);
    }

    public function postToPasteBin(Request $request) { 
        $input = $request->all(); 
        $draft = new Draft(); // drafts represent unsent pastes
        $draft->setContent($input['payload']); // set the paste content

        // an Account object represents a Pastebin user account
        $account = new Account(new Credentials('jamongkad', 'p455w0rd'));

        // link the draft to the account
        $draft->setOwner($account);
 
        // specify that we don't want this paste to be publicly accessible
        $draft->setVisibility(Visibility::VISIBILITY_PUBLIC);

        // use our developer key
        $developer = new Developer('ec3a299132c1ad0c179f05ca24670cd0');
        
        try {
            // send the draft to Pastebin; turn it into a full blown Paste object
            $paste = $draft->paste($developer);
            // e.g. {"status" : "success", "pastebin_url" : "http://pastebin.com/JYvbS0fC"} 
            return response()->json(["status" => "success", "pastebin_url" => $paste->getUrl()]);
        }
        catch (BrushException $e) {
            // some sort of error occurred; check the message for the cause
            return response()->json(["status" => "failed", "message" => $e->getMessage()]);
        }
    }
}
