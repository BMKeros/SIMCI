<?php

	class DataSheetController extends BaseController {

        public function getGenerarPdf($id){
            $vista = View::make('datasheet.modelo_pdf_datasheet')->render();

            $pdf = PDF::loadHTML($vista);

            return $pdf->stream();

        }

    }