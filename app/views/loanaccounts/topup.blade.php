@extends('layouts.accounting')
@section('content')
<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 800px; /* New width for default modal */
        }
        .modal-sm {
          width: 400px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>
<br/>
<div class="row">
	<div class="col-lg-3">
    <h3>Loan Top Up</h3> 
  </div>  
  <div class="col-lg-3" style="margin-top: 2%;">
     @if($loanaccount->is_top_up==1)
    <button  data-toggle="modal" data-target="#topups" class="btn btn-warning">
      View Topups
    </button>
    @endif
  </div>
</div>
<hr>
<div class="row">
	<div class="col-lg-5">
		 @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif
		 <form method="POST" action="{{{ URL::to('loanaccounts/topup/'.$loanaccount->id) }}}" accept-charset="UTF-8">
    <fieldset>


      

  
<?php $date = date('Y-m-d'); ?>
        <div class="form-group">
            <label for="username">Top up Date </label>
          <input class="form-control" placeholder="" type="date" name="top_up_date" id="application_date" value="{{$date}}">
        </div>
        <div class="form-group">
            <label for="username">Top Up Amount</label>
            <input class="form-control" placeholder="" type="text" name="amount" id="amount_applied" value="{{{ Input::old('to_up_amount') }}}">
        </div>
        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary btn-sm">Submit</button> 
        </div>
    </fieldset>
</form>
  </div>
</div>
<?php
function asMoney($value) {
  return number_format($value, 2);
}
?>
<!-- Top ups Modal -->
<div class="modal fade " id="topups" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content col-lg-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Loan Topups
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
         <a href="{{URL::to('loans/topupReport/'.$loanaccount->id)}}" class="btn btn-sm btn-success">Print</a></h4>        
      </div>
      <div class="modal-body ">
        <table id="users" class="table table-condensed table-hover table-bodered">
            <thead>
              <th>Top Up Amount</th>
              <th>Top Up Interest</th>
              <th>Total Payable</th>
              <th>Date Topped</th>              
            </thead>
            <tbody>
              @foreach($topups as $loanaccount)             
                <tr>
                  <td>{{ $loanaccount->amount}}</td>
                  <td>{{ asMoney(($loanaccount->total_payable)-($loanaccount->amount))}}</td>
                  <td>{{ asMoney($loanaccount->total_payable)}}</td>
                  <td>{{$loanaccount->created_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
      <div class="modal-footer">        
        <div class="form-actions form-group">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>        
        </div>
      </div>
    </div>
  </div>
</div>
@stop