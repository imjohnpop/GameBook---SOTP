<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
        $view = view('gamebook/sign');
        return $view;
    }
    public function start() {
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $data = DB::select("SELECT `chapter`.`id` AS `chapter_id`,
                      `chapter`.`text` AS `chapter_text`,
                      `choice`.`text` AS `chapter_options`,
                      `choice`.`goto_id` AS `chapter_next`,
                      `illustration`.`filename` AS `chapter_pic`
                  FROM `chapter`
                  LEFT JOIN `choice`
                  ON `chapter`.`id` = `choice`.`chapter_id`
                  LEFT JOIN `illustration`
                  ON `chapter`.`id` = `illustration`.`chapter_id`
                  LEFT JOIN `users`
                  ON `choice`.`chapter_id` = `users`.`goto`
                  WHERE `chapter`.`id` = ?", [$id]);
            $view = view('gamebook/index');
            $view->data = $data;
            auth()->user()->goto = $_POST['id'];
            auth()->user()->save();
            return $view;
        } else {
            $id = auth()->user()->goto;
            $data = DB::select("SELECT `chapter`.`id` AS `chapter_id`,
                      `chapter`.`text` AS `chapter_text`,
                      `choice`.`text` AS `chapter_options`,
                      `choice`.`goto_id` AS `chapter_next`,
                      `illustration`.`filename` AS `chapter_pic`
                  FROM `chapter`
                  LEFT JOIN `choice`
                  ON `chapter`.`id` = `choice`.`chapter_id`
                  LEFT JOIN `illustration`
                  ON `chapter`.`id` = `illustration`.`chapter_id`
                  LEFT JOIN `users`
                  ON `choice`.`chapter_id` = `users`.`goto`
                  WHERE `chapter`.`id` = ?", [$id]);
            $view = view('gamebook/index');
            $view->data = $data;
            return $view;
        }
    }
}
