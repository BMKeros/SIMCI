<?php

	class DataSheetController extends BaseController {

        public function getGenerarPdf($id){
            return View::make('datasheet.modelo_pdf_datasheet');
        }

    }