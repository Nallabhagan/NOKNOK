<?php

namespace App\Helpers;

use App\Follower;
use App\Interview;
use App\MediaHouse;
use App\NokItComment;
use App\NokItLike;
use App\Question;
use App\StarAnswer;
use App\User;
use Vinkla\Hashids\Facades\Hashids;
class Helper
{
	public static function username($id) {
		$user = User::select('name')->where(["id" => $id])->first();
		return $user->name;
	}

	public static function user_social_links($id) {
		$user = User::select('fb','twitter','linkedin','insta')->where(["id" => $id])->first();
		return $user;
	}

	public static function user_media_house_id($id) {
		$media_house_id = User::select('media_house')->where(["id" => $id])->first();
		return $media_house_id->media_house;
	}

	public static function user_profile_pic($id) {

		$user = User::select('profile_pic')->where(["id" => $id])->first();

		if(filter_var($user->profile_pic, FILTER_VALIDATE_URL))
		{
		    return $user->profile_pic;
		}
		else
		{
			return url('assets/user_profile')."/".$user->profile_pic;
		}
	}

	public static function interview_question_details($question_id) {
		$interview = Question::find($question_id);
		return $interview;
	}

	public static function media_name($id) {
		$media = MediaHouse::select('name')->where(["id" => $id])->first();
		return $media->name;
	}
	public static function media_description($id) {
		$media = MediaHouse::select('description')->where(["id" => $id])->first();
		return $media->description;
	}
	
	public static function follow_check($userid,$following_id)
	{
		$row = Follower::where(['user_id'=>$userid,'following_id'=>$following_id])->first();
		if($row != null)
		{
			return true;
		}
	}

	public static function follow_count($id)
	{
		$follower_count = Follower::select('user_id')->where(['following_id' => $id])->count();
		return $follower_count;
	}

	public static function like_check($userid,$nokit_id)
	{
		$row = NokItLike::where(['user_id'=>$userid,'nok_it_id'=>$nokit_id])->first();
		if($row != null)
		{
			return true;
		}
	}

	public static function comment_count($id)
	{
		$comment_count = NokItComment::select('user_id')->where(['nok_it_id' => $id])->count();
		return $comment_count;
	}

	public static function like_count($id)
	{
		$like_count = NokItLike::select('user_id')->where(['nok_it_id' => $id])->count();
		return $like_count;
	}

	public static function answers_count($id)
	{
		$answer_count = Interview::select('id')->where(['question_id' => $id])->count();
		return $answer_count;
	}
}