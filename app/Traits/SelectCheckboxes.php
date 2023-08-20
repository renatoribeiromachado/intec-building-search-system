<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

trait SelectCheckboxes {

    public function pushToSession(
        $instance,
        $sessionName = '',
        $responseIndex = ''
    ) {
        $inputChecked = [];
        if (session()->has($sessionName)){
            $inputChecked = session()->get($sessionName);
        }

        $inputChecked = array_merge($inputChecked, [$instance]);

        request()->session()->put($sessionName, $inputChecked);

        return response()->json(
            [$responseIndex => session($sessionName)],
            Response::HTTP_OK
        );
    }

    public function removeFromSession(
        $instance,
        $sessionName = '',
        $responseIndex = ''
    ) {
        $selectedInputs = session($sessionName);

        if (($key = array_search($instance, $selectedInputs)) !== false) {
            unset($selectedInputs[$key]);
            $selectedInputs = array_values($selectedInputs);
        }
        
        request()->session()->put($sessionName, $selectedInputs);

        return response()->json(
            [$responseIndex => session($sessionName)],
            Response::HTTP_OK
        );
    }

    public function checkAllInputs(
        Request $request,
        $ids,
        $inputSelectAllWasClicked,
        $clickedInPage1,
        $inputPageOfPagination1,
        $sessionName = '',
        $responseIndex = ''
    ) {
        $inputSelectAllWasClicked = (bool) $inputSelectAllWasClicked;
        $clickedInPage = $clickedInPage1;
        $inputPageOfPagination = $inputPageOfPagination1;
        
        if (! session()->has($sessionName)) {
            request()->session()->put(
                $sessionName,
                $ids
            );

            request()->session()->put(
                'btnSelectAll', [
                    'btn_clicked' => 1,
                    'page_of_pagination' => $inputPageOfPagination,
                    'clicked_in_page' => $clickedInPage
                ]
            );
        } elseif (session()->has($sessionName)) {
            request()->session()->forget(
                $sessionName
            );

            request()->session()->put(
                $sessionName,
                $ids
            );

            request()->session()->forget(
                'btnSelectAll'
            );

            request()->session()->put(
                'btnSelectAll', [
                    'btn_clicked' => 0,
                    'page_of_pagination' => $inputPageOfPagination,
                    'clicked_in_page' => $inputSelectAllWasClicked
                        ? $clickedInPage
                        : $inputPageOfPagination
                ]
            );
        }

        return response()->json(
            [$responseIndex => $ids],
            Response::HTTP_OK
        );
    }
}