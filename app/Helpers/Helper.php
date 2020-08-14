<?php

namespace App\Helpers;

use App\Follower;
use App\Interview;
use App\MediaHouse;
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

	public static function user_profile_pic($id) {
		$user = User::select('profile_pic')->where(["id" => $id])->first();
		return $user->profile_pic;
	}

	public static function interview_question_details($question_id) {
		$interview = Question::find($question_id);
		return $interview;
	}

	public static function star_answer_check($interview_id,$answer_index)
	{
		$row = StarAnswer::where(['interview_id'=>$interview_id,'answer_index'=>$answer_index])->first();
		if($row != null)
		{
			return true;
		}
	}

	public static function get_star_answer($interview_id,$answer_index)
	{
		$answer = Interview::select('question_id', 'slug','user_id','answers')->where(["id" => $interview_id])->first();

		$question = Question::select('questions')->where(["id" => $answer->question_id])->first();
		
		$data = [
			"answer" => $answer->answers[$answer_index],
			"user_name" => self::username($answer->user_id),
			"profile_url" => url('user').'/'.Hashids::connection('user')->encode($answer->user_id),
			"interview_url" => url('interview').'/'.Hashids::connection('answer_slug')->encode($answer->user_id).'/'.$answer->slug,
			"question" => $question->questions[$answer_index]
		];
		return $data;
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
}