<?php

	class DataSheetController extends BaseController {

        public function getGenerarPdf($id){
            
            $data = array('reactivo' => Catalogo::find($id));

            $vista = View::make('datasheet.modelo_pdf_datasheet', $data)->render();

            $pdf = PDF::loadHTML($vista);

            return $pdf->stream();
        }

    }