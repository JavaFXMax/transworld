<?php

class Member extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'name' => 'required',
		 'membership_no' => 'required',
		 'branch_id' => 'required',
		 'phone' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function branch(){

		return $this->belongsTo('Branch');
	}

	public function group(){

		return $this->belongsTo('Group');
	}

	public function kins(){

		return $this->hasMany('Kin');
	}


	public function savingaccounts(){

		return $this->hasMany('Savingaccount');
	}


	public function shareaccount(){

		return $this->hasOne('Shareaccount');
	}

	public function vehicles(){

		return $this->hasMany('Vehicle');
	}



	public function loanaccounts(){

		return $this->hasMany('Loanaccount');
	}

	public function documents(){

		return $this->hasMany('Document');
	}


	public function guarantors(){

		return $this->hasMany('Loanguarantor');
	}



	public static function getMemberAccount($id){

		$account_id = DB::table('savingaccounts')->where('member_id', '=', $id)->pluck('id');

		$account = Savingaccount::find($account_id);

		return $account;
	}

	public static function getMemberName($id){

		$member = Member::find($id);

		return $member->name;
	}

	public static function getMemberNo($id){

		$member = Member::find($id);

		return $member->membership_no;
	}
}