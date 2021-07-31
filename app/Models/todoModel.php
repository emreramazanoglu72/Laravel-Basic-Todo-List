<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class todoModel extends Model
{
    use HasFactory;

    public function getTodoList()
    {
        return DB::table('listtodo')->orderBy("created_at","desc")->get();
    }

    public function saveTodo($title)
    {
        $control = DB::table('listtodo')->insert([
            "title" => $title,
        ]);

        if ($control) {
            return true;
        } else {
            return false;
        }
    }

    public function todoRemove(int $id)
    {
        DB::table('listtodo')->where("id", $id)->delete();
    }

    public function changeStatus(int $id)
    {
        $item = DB::table('listtodo')->where('id', $id)->first();

        $change = $item->status ? false : true;

        DB::table('listtodo')->where("id", $id)->update(['status' => $change]);

    }
}
