<?php
/**
 * 	REST Controller
 * 	
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Luisb\Pse\SoapService;
use App\Http\Requests;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;


class Pse extends Controller
{
	/**
	 * 	Get the bank list
	 *  @return mixed
	 */
	public function getBankList(Request $request) {
		$ptp_test = new SoapService();
		return response()->json($ptp_test->bankList()->item,HttpResponse::HTTP_OK);
	}
	/**
	 * 	Create transaction
	 * 	@param array
	 */
	public function createTransaction(Request $request){
		$ptp_test = new SoapService();
		$request->merge([ 'ipAddress' => $request->ip()]);
		$request->merge([ 'userAgent' => $request->header('User-Agent') ]);
	    return	response()->json($ptp_test->beginTransaction($request->all()),HttpResponse::HTTP_CREATED);
	}
	/**
	 * 	Get the transaction information by transactionID
	 * 	@param string
	 *  @return mixed
	 */
	public function getTransactionInformation($transactionId){
		$ptp_test = new SoapService();
		return response()->json($ptp_test->findTransaction($transactionId),HttpResponse::HTTP_OK);
	}
	/**
	 * 	Create transaction multicredit
	 * 	@param array
	 */
	public function createTransactionMulticredit(Request $request){
		$form = array( "bankCode"=>"1022", "bankInterface"=>"0", "returnURL"=>'https://www.google.com.co', "reference"=>"1455", "description"=>"Test", "language"=>"ES", "currency"=>"COP", "totalAmount"=>5000, "taxAmount"=>0.0, "devolutionBase"=>0.0, "tipAmount"=>0, 'ipAddress'=>"182.143.213.30", "userAgent"=>"Chrome", "additionalData"=>"", "payer"=>array( "documentType"=>"CC", "document"=>"12345", "emailAddress"=>"aaaasdasa@adasdads.com" ) );
		$ptp_test = new SoapService();
		$ptp_test->beginTransactionMulticredit($form);
	}
}
