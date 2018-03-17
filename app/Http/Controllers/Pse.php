<?php
/**
 * 	REST Controller.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Luisb\Pse\SoapService;

class Pse extends Controller
{
    /**
     * 	Get the bank list.
     *
     *  @return mixed
     */
    public function getBankList(Request $request)
    {
        $ptp_test = new SoapService();

        return response()->json($ptp_test->bankList()->item, HttpResponse::HTTP_OK);
    }

    /**
     * 	Create transaction.
     *
     * 	@param array
     */
    public function createTransaction(Request $request)
    {
        $ptp_test = new SoapService();
        $request->merge(['ipAddress' => $request->ip()]);
        $request->merge(['userAgent' => $request->header('User-Agent')]);

        return response()->json($ptp_test->beginTransaction($request->all()), HttpResponse::HTTP_CREATED);
    }

    /**
     * 	Get the transaction information by transactionID.
     *
     * 	@param string
     *
     *  @return mixed
     */
    public function getTransactionInformation($transactionId)
    {
        $ptp_test = new SoapService();

        return response()->json($ptp_test->findTransaction($transactionId), HttpResponse::HTTP_OK);
    }

    /**
     * 	Create transaction multicredit.
     *
     * 	@param array
     */
    public function createTransactionMulticredit(Request $request)
    {
        $ptp_test = new SoapService();
        $request->merge(['ipAddress' => $request->ip()]);
        $request->merge(['userAgent' => $request->header('User-Agent')]);

        return response()->json($ptp_test->beginTransactionMulticredit($request->all()), HttpResponse::HTTP_CREATED);
    }
}
