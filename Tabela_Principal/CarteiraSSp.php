<?php

class SSPCA {

	static function data_outputCA ( $columns, $data )
	{
		$out = array();
		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
			$row = array();
			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
				$column = $columns[$j];
				// Is there a formatter?
				if ( isset( $column['formatter'] ) ) {
					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
				}
				else {
					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
				}
			}
			$out[] = $row;
		}
		return $out;
	}
	
	static function simpleCA ( $request, $urlGetDoc,  $columns )
	{
		$data = json_decode(file_get_contents($urlGetDoc),true);
		return array(
			"draw"            => isset ($request['draw']) ?
				intval( $request['draw']) :
				0,
			"recordsTotal"    => intval( count($data) ),
			"recordsFiltered" => intval( 0 ),
			"data"            => self::data_outputCA( $columns, $data )
		);
	}
}