@extends('layouts.main')
@section('content')
<br/>

<div class="row">
	<div class="col-lg-12">
  <strong>Member: {{ $member->name }}</strong><br>
  <strong>Member #: {{ $member->membership_no }}</strong><br>
<strong>Share Account #: {{ $shareaccount->account_number }}</strong><br>
<hr>
</div>	
</div>
<div class="row">
	<div class="col-lg-4">
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
        <?php
            $member= Member::where('id','=',$shareaccount->member_id)->get()->first();
            $share_limit=Member::checkContribution($member->id, 'shares');
            $membership_limit=Member::checkContribution($member->id, 'membership');
        ?>
		 <form method="POST" action="{{{ URL::to('sharetransactions') }}}" accept-charset="UTF-8">
            <fieldset>
                @if($share_limit != 'paid' && $membership_limit !='paid')
                <div class="form-group">
                    <label for="username">Transaction </label>
                   <select name="type" class="form-control" required>
                       <option></option>
                       <option value="credit"> Purchase</option>
                   </select>
                </div>
                @else
                <div class="form-group">
                  <label for="username">Transaction </label>
                   <select name="type" class="form-control" disabled>
                       <option></option>
                       <option value="credit"> Purchase</option>
                   </select>
                </div>
                @endif
                <input type="hidden" name="account_id" value="{{ $shareaccount->id}}">
                <div class="form-group">
                    <label for="username"> Date</label>
                    <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker" placeholder="" readonly type="text" name="date" id="date" value="{{{ Input::old('date') }}}" required>
                    </div>
                </div>
                @if($membership_limit != 'paid')
                <div class="form-group">
                    <label for="username">Membership Fee</label>
                    <input class="form-control" type="text" name="fee_amount"
                           value="{{Input::old('fee_amount')}}">
                </div>
                @else
                <div class="form-group">
                    <label for="username">Membership Fee</label>
                    <input class="form-control" type="text" name="fee_amount"
                           value="PAID" disabled>
                </div>
                @endif
                @if($share_limit !='paid')
                <div class="form-group">
                    <label for="username"> Shares</label>
                    <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="{{{ Input::old('amount') }}}" required>
                </div>
                @else
                <div class="form-group">
                    <label for="username"> Shares</label>
                    <input class="form-control" placeholder="" type="text" name="amount" id="amount" value="PAID" disabled>
                </div>
                @endif
                @if($share_limit != 'paid' && $membership_limit !='paid')
                <div class="form-group">
                    <label for="username"> Description</label>
                    <textarea class="form-control" name="description">{{{ Input::old('description') }}}</textarea>
                </div>
                @else
                <div class="form-group">
                    <label for="username"> Description</label>
                    <textarea class="form-control" name="description" disabled>
                        {{{ Input::old('description') }}}</textarea>
                </div>
                @endif
                @if($share_limit != 'paid' && $membership_limit !='paid')
                <div class="form-actions form-group">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
                @else
                <div class="form-actions form-group">
                  <button type="submit" class="btn btn-primary btn-sm" disabled>Already Paid in Full</button>
                </div>
                @endif
            </fieldset>
        </form>
  </div>
</div>

@stop