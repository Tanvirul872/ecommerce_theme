<?php

use BinaryIT\Invoice\PDF;

// $font_path = __DIR__ . '/Montserrat-Regular.ttf';
// $font_name = $pdf->covertFont($font_path);




/**
 * Register Wordpress Form Action
 * */

add_action('admin_post_nopriv_print_product_info', 'print_product_info');
add_action('admin_post_print_product_info', 'print_product_info');
function print_product_info()
{

	$product_id 		= $_POST['product_id'] ?? '';
	$product_title 		= $_POST['product_title'] ?? '';
	$is_en_available 	= $_POST['is_en_available'] ?? '';


	$final_product_title = '';
	if ($is_en_available == 'en') {
		$final_product_title = str_replace('μ', 'µ', get_post_meta($product_id, 'product_title_en', true));
	} else {
		$final_product_title = str_replace('μ', 'µ', $product_title);
	}

	// Top text
	$final_top_text = '';
	if ($is_en_available == 'en') {
		$final_top_text = get_post_meta($product_id, 'tv_post_top_text_en', true);
	} else {
		$final_top_text = get_post_meta($product_id, 'tv_post_top_text', true);
	}

	// Table 1 header title
	$final_tv_table_1_head_title = '';
	if ($is_en_available == 'en') {
		$final_tv_table_1_head_title = get_post_meta($product_id, 'tv_table_1_head_title_en', true);
	} else {
		$final_tv_table_1_head_title = get_post_meta($product_id, 'tv_table_1_head_title', true);
	}

?>
<?php
	$pdf = new PDF();

	// $font_path = __DIR__ . '/Poppins-Light.ttf';
	// $font_name = $pdf->covertFont($font_path);

	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 48, PDF_MARGIN_RIGHT);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 8);


	$header = <<<DOC
		<table>
	    <tr>
		  	<td style="width: 30%;">
		    	<img src="https://saro.red-apple.it/wp-content/uploads/2023/07/red-line.jpg" height="200px" width="auto">  
			</td>
	        <td style="text-align:right; width: 65%;">
			   <span style="line-height:20px"></span><br><br>
	           <img src="https://saro.red-apple.it/wp-content/uploads/2023/07/logo-black.jpg" height="30px" width="170px">  
			   <span></span> <br><br>
			   <h2 style="color:#CD151D;font-size:22px; font-family: poppinsb; line-height: 35px; "> {$final_product_title}</h2>
	        </td>
			<td style="width: 5%;"></td>
	    </tr>
	</table>
DOC;

	$footer = <<<DOC
	<table>
	<tr>
		<td style="width:5%;"></td>
		<td style="width: 25%; ">
			<span style="color:#CD151D; font-size:10px; font-family: poppinssemib; ">SARO SRL <br></span> 
			<span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;">Sede legale <br></span>  
			<span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">Viale San Gimignano, 35 <br></span>
			<span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">20146 Milano (MI)</span>
		</td>
		<td style="width: 25%; ">
			<span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;"><br>Sede operativa<br></span> 
			<span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">Via G. Di Vittorio, 5<br></span> 
			<span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">20020 Arconate (MI)</span>   
		</td>
		<td style="width: 40%; ">
			<span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;"><br><br>T.0331 453794 - F.0331 574495</span>  <br>
			<span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;">info@sa.ro.it - <b><span style="font-family: poppinsb;">www.sa.ro.it</span></b> </span> 
			<br>
		</td>
		<td style="width:5%;"></td>
	</tr>
	<tr>
		<td style="width:5%;"></td> 
		<td style="width:90%;">
			<div style="width:100%;background-color:#CD151D;line-height:3px;"></div>
		</td>
		<td style="width:5%;"></td>
	</tr>
</table>
DOC;

	$pdf->headerHTML($header);
	$pdf->footerHTML($footer);

	$pdf->AddPage();
	$html = '';
	$html .= <<<DOC
	<table>
		<tr>
			<td style="width: 5%"></td>
			<td style="width: 90%; text-align: right; ">
				<span style="font-family: poppinssemib; color: #b70202; text-transform: uppercase; font-size: 10px; ">DESCRIZIONE PRODOTTO <br></span>
				<span style="font-family: poppins; font-size: 9px; "> {$final_top_text} </span>
			</td>
			<td style="width: 5%"></td>
		</tr>
	</table>
	<br>
	<br>
DOC;

	if ($final_tv_table_1_head_title) {
		$html .= <<<DOC
	<table>
		<tr>
			<td style="width: 5%"></td>
			<td style="width: 90%; text-align: center; font-family: poppinsb; background-color: #B80103; color: #fff;  text-transform: uppercase; line-height: 23px; font-size: 9px; ">
				<span style="">{$final_tv_table_1_head_title}</span>
			</td>
			<td style="width: 5%"></td>
		</tr>
	</table>
DOC;
	}

	/**
	 * start table 1
	 * how_many_columns_need
	 */

	$totan_columns_t1 = get_post_meta($product_id, 'how_many_columns_need', true);

	if ($totan_columns_t1 == 2) {
		$tb_width = '45%';
	} elseif ($totan_columns_t1 == 3) {
		$tb_width = '30%';
	} elseif ($totan_columns_t1 == 4) {
		$tb_width = '22.5%';
	} elseif ($totan_columns_t1 == 5) {
		$tb_width = '18%';
	} elseif ($totan_columns_t1 == 6) {
		$tb_width = '15%';
	} elseif ($totan_columns_t1 == 7) {
		$tb_width = '12.8%';
	} elseif ($totan_columns_t1 == 8) {
		$tb_width = '11,25%';
	} elseif ($totan_columns_t1 == 9) {
		$tb_width = '10%';
	} elseif ($totan_columns_t1 == 10) {
		$tb_width = '9%';
	} elseif ($totan_columns_t1 == 11) {
		$tb_width = '8.2%';
	}

	$table_one_row = '';
	if ($is_en_available == 'en') {

		$table_rows_en1 = get_post_meta($product_id, 'table_columns_en_one', true);

		for ($en1_i = 0; $en1_i < $table_rows_en1; $en1_i++) {

			$set_bg = '';
			if ($en1_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_one_row .= '<tr>';
			$table_one_row .= '<td style="width: 5%;"></td>';

			$tc_column_en_1 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_1', true);
			$tc_column_en_2 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_2', true);
			$tc_column_en_3 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_3', true);
			$tc_column_en_4 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_4', true);
			$tc_column_en_5 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_5', true);
			$tc_column_en_6 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_6', true);
			$tc_column_en_7 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_7', true);
			$tc_column_en_8 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_8', true);
			$tc_column_en_9 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_9', true);
			$tc_column_en_10 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_10', true);
			$tc_column_en_11 = get_post_meta($product_id, 'table_columns_en_one_' . $en1_i . '_tc_column_en_11', true);


			// if ($tc_column_en_1) {
				$table_one_row .= '
		 <td style="background-color: ' . $set_bg . '; width: ' . $tb_width . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
		 <span>' . $tc_column_en_1 . '</span>
		 </td>
		 ';
			// }

			// if ($tc_column_en_2) {

				$set_border_right = '';
				if ($totan_columns_t1 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
		 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
		 <span>' . $tc_column_en_2 . '</span>
		 </td>
		 ';
			// }

			if ($totan_columns_t1 > 2 || $totan_columns_t1 == 3) {

				$set_border_right = '';
				if ($totan_columns_t1 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_3 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 3 || $totan_columns_t1 == 4) {

				$set_border_right = '';
				if ($totan_columns_t1 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_4 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 4 || $totan_columns_t1 == 5) {

				$set_border_right = '';
				if ($totan_columns_t1 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_5 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 5 || $totan_columns_t1 == 6) {

				$set_border_right = '';
				if ($totan_columns_t1 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_6 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 6 || $totan_columns_t1 == 7) {

				$set_border_right = '';
				if ($totan_columns_t1 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_7 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 7 || $totan_columns_t1 == 8) {

				$set_border_right = '';
				if ($totan_columns_t1 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_8 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 8 || $totan_columns_t1 == 9) {

				$set_border_right = '';
				if ($totan_columns_t1 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_9 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 9 || $totan_columns_t1 == 10) {

				$set_border_right = '';
				if ($totan_columns_t1 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_10 . '</span>
			 </td>
			 ';
			}

			if ($totan_columns_t1 > 10 || $totan_columns_t1 == 11) {

				$set_border_right = '';
				if ($totan_columns_t1 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
			 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_en_11 . '</span>
			 </td>
			 ';
			}

			$table_one_row .= '<td style="width: 5%"></td>';
			$table_one_row .= '</tr>';
		}
	} else {

		$table_rows_it1 = get_post_meta($product_id, 'table_columns_it_one', true);

		for ($it1_i = 0; $it1_i < $table_rows_it1; $it1_i++) {

			$set_bg = '';
			if ($it1_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_one_row .= '<tr>';
			$table_one_row .= '<td style="width: 5%;"></td>';

			$tc_column_it_1 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_1', true);
			$tc_column_it_2 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_2', true);
			$tc_column_it_3 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_3', true);
			$tc_column_it_4 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_4', true);
			$tc_column_it_5 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_5', true);
			$tc_column_it_6 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_6', true);
			$tc_column_it_7 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_7', true);
			$tc_column_it_8 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_8', true);
			$tc_column_it_9 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_9', true);
			$tc_column_it_10 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_10', true);
			$tc_column_it_11 = get_post_meta($product_id, 'table_columns_it_one_' . $it1_i . '_tc_column_it_11', true);


			// if ($tc_column_it_1) {
				$table_one_row .= '
				 <td style="background-color: ' . $set_bg . '; width: ' . $tb_width . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
				 <span>' . $tc_column_it_1 . '</span>
				 </td>
				 ';
			// }

			// if ($tc_column_it_2) {

				$set_border_right = '';
				if ($totan_columns_t1 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
				 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
				 <span>' . $tc_column_it_2 . '</span>
				 </td>
				 ';
			// }

			if ($totan_columns_t1 > 2 || $totan_columns_t1 == 3) {

				$set_border_right = '';
				if ($totan_columns_t1 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_3 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 3 || $totan_columns_t1 == 4) {

				$set_border_right = '';
				if ($totan_columns_t1 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_4 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 4 || $totan_columns_t1 == 5) {

				$set_border_right = '';
				if ($totan_columns_t1 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_5 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 5 || $totan_columns_t1 == 6) {

				$set_border_right = '';
				if ($totan_columns_t1 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_6 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 6 || $totan_columns_t1 == 7) {

				$set_border_right = '';
				if ($totan_columns_t1 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_7 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 7 || $totan_columns_t1 == 8) {

				$set_border_right = '';
				if ($totan_columns_t1 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_8 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 8 || $totan_columns_t1 == 9) {

				$set_border_right = '';
				if ($totan_columns_t1 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_9 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 9 || $totan_columns_t1 == 10) {

				$set_border_right = '';
				if ($totan_columns_t1 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_10 . '</span>
					 </td>
					 ';
			}

			if ($totan_columns_t1 > 10 || $totan_columns_t1 == 11) {

				$set_border_right = '';
				if ($totan_columns_t1 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_one_row .= '
					 <td style="background-color: ' . $set_bg . ';  width: ' . $tb_width . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
					 <span>' . $tc_column_it_11 . '</span>
					 </td>
					 ';
			}


			$table_one_row .= '<td style="width: 5%"></td>';
			$table_one_row .= '</tr>';
		}
	}

	$html .= <<<DOC
<table cellmargin="0" cellpadding="2" style="">
	{$table_one_row}
</table>
DOC;

	/**
	 * end table 1
	 * how_many_columns_need
	 */


	/**
	 * Start 2nd page 
	 */

	$tv_post_title_after_tbl_1 = get_post_meta($product_id, 'tv_post_title_after_tbl_1', true);

	$final_tv_post_title_text = '';
	if ($is_en_available == 'en') {
		$final_tv_post_title_text = get_post_meta($product_id, 'tv_post_title_after_tbl_1_en', true);
	} else {
		$final_tv_post_title_text = get_post_meta($product_id, 'tv_post_title_after_tbl_1', true);
	}

	$final_tv_post_pro_desc = '';
	if ($is_en_available == 'en') {
		$final_tv_post_pro_desc = get_post_meta($product_id, 'tv_post_pro_desc_en', true);
	} else {
		$final_tv_post_pro_desc = get_post_meta($product_id, 'tv_post_pro_desc', true);
	}

	// start product description

	$html .= <<<DOC
	<p style="page-break-before: always"></p>
	<table cellmargin="0" cellpadding="2" style="">
		<tr>
			<td style="width: 5%"></td>
			<td style="width: 90%">
				<span style="line-height: 18px; font-family: poppinssemib; color: #b70202; text-transform: uppercase; font-size: 10px;">{$final_tv_post_title_text}<br></span>
				<span style="font-family: poppins; font-size: 9px; color: #5a5a5a; text-align: justify; display: block;  ">{$final_tv_post_pro_desc}</span>
			</td>
			<td style="width: 5%"></td>
		</tr>
	</table>
	<br/>
	<br/>
DOC;



	/**
	 * start table 2
	 * how_many_columns_need
	 */

	$final_tv_table_2_head_title = '';
	if ($is_en_available == 'en') {
		$final_tv_table_2_head_title = get_post_meta($product_id, 'tv_table_2_head_title_en', true);
	} else {
		$final_tv_table_2_head_title = get_post_meta($product_id, 'tv_table_2_head_title', true);
	}

	if ($final_tv_table_2_head_title) {
		$html .= <<<DOC
	  <table>
		  <tr>
			  <td style="width: 5%"></td>
			  <td style="width: 90%; text-align: center; font-family: poppinsb; background-color: #B80103; color: #fff;  text-transform: uppercase; line-height: 25px; font-size: 10px; ">
				  <span style="">{$final_tv_table_2_head_title}</span>
			  </td>
			  <td style="width: 5%"></td>
		  </tr>
	  </table>
DOC;
	}


	$totan_columns_t2 = get_post_meta($product_id, 'how_many_columns_need_two', true);

	if ($totan_columns_t2 == 2) {
		$tb_width_2 = '45%';
	} elseif ($totan_columns_t2 == 3) {
		$tb_width_2 = '30%';
	} elseif ($totan_columns_t2 == 4) {
		$tb_width_2 = '22.5%';
	} elseif ($totan_columns_t2 == 5) {
		$tb_width_2 = '18%';
	} elseif ($totan_columns_t2 == 6) {
		$tb_width_2 = '15%';
	} elseif ($totan_columns_t2 == 7) {
		$tb_width_2 = '12.8%';
	} elseif ($totan_columns_t2 == 8) {
		$tb_width_2 = '11,25%';
	} elseif ($totan_columns_t2 == 9) {
		$tb_width_2 = '10%';
	} elseif ($totan_columns_t2 == 10) {
		$tb_width_2 = '9%';
	} elseif ($totan_columns_t2 == 11) {
		$tb_width_2 = '8.2%';
	}

	$table_two_row = '';
	if ($is_en_available == 'en') {

		$table_rows_en2 = get_post_meta($product_id, 'table_columns_en_two', true);

		for ($en2_i = 0; $en2_i < $table_rows_en2; $en2_i++) {

			$set_bg = '';
			if ($en2_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_two_row .= '<tr>';
			$table_two_row .= '<td style="width: 5%;"></td>';

			$tc_column_2_en_1 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_1', true);
			$tc_column_2_en_2 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_2', true);
			$tc_column_2_en_3 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_3', true);
			$tc_column_2_en_4 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_4', true);
			$tc_column_2_en_5 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_5', true);
			$tc_column_2_en_6 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_6', true);
			$tc_column_2_en_7 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_7', true);
			$tc_column_2_en_8 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_8', true);
			$tc_column_2_en_9 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_9', true);
			$tc_column_2_en_10 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_10', true);
			$tc_column_2_en_11 = get_post_meta($product_id, 'table_columns_en_two_' . $en2_i . '_tc_column_2_en_11', true);


			// if ($tc_column_2_en_1) {
				$table_two_row .= '
			<td style="background-color: ' . $set_bg . '; width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
			<span>' . $tc_column_2_en_1 . '</span>
			</td>
			';
			// }

			// if ($tc_column_2_en_2) {

				$set_border_right = '';
				if ($totan_columns_t2 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
			<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
			<span>' . $tc_column_2_en_2 . '</span>
			</td>
			';
			// }

			if ($totan_columns_t2 > 2 || $totan_columns_t2 == 3) {

				$set_border_right = '';
				if ($totan_columns_t2 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_3 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 3 || $totan_columns_t2 == 4) {

				$set_border_right = '';
				if ($totan_columns_t2 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_4 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 4 || $totan_columns_t2 == 5) {

				$set_border_right = '';
				if ($totan_columns_t2 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_5 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 5 || $totan_columns_t2 == 6) {

				$set_border_right = '';
				if ($totan_columns_t2 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_6 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 6 || $totan_columns_t2 == 7) {

				$set_border_right = '';
				if ($totan_columns_t2 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_7 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 7 || $totan_columns_t2 == 8) {

				$set_border_right = '';
				if ($totan_columns_t2 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_8 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 8 || $totan_columns_t2 == 9) {

				$set_border_right = '';
				if ($totan_columns_t2 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_9 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 9 || $totan_columns_t2 == 10) {

				$set_border_right = '';
				if ($totan_columns_t2 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_10 . '</span>
				</td>
				';
			}

			if ($totan_columns_t2 > 10 || $totan_columns_t2 == 11) {

				$set_border_right = '';
				if ($totan_columns_t2 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_2_en_11 . '</span>
				</td>
				';
			}

			$table_two_row .= '<td style="width: 5%"></td>';
			$table_two_row .= '</tr>';
		}
	} else {

		$table_rows_it2 = get_post_meta($product_id, 'table_columns_it_two', true);

		for ($it2_i = 0; $it2_i < $table_rows_it2; $it2_i++) {

			$set_bg = '';
			if ($it2_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_two_row .= '<tr>';
			$table_two_row .= '<td style="width: 5%;"></td>';

			$tc_column_2_it_1 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_1', true);
			$tc_column_2_it_2 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_2', true);
			$tc_column_2_it_3 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_3', true);
			$tc_column_2_it_4 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_4', true);
			$tc_column_2_it_5 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_5', true);
			$tc_column_2_it_6 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_6', true);
			$tc_column_2_it_7 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_7', true);
			$tc_column_2_it_8 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_8', true);
			$tc_column_2_it_9 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_9', true);
			$tc_column_2_it_10 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_10', true);
			$tc_column_2_it_11 = get_post_meta($product_id, 'table_columns_it_two_' . $it2_i . '_tc_column_2_it_11', true);


			// if ($tc_column_2_it_1) {
				$table_two_row .= '
					<td style="background-color: ' . $set_bg . '; width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
					<span>' . $tc_column_2_it_1 . '</span>
					</td>
					';
			// }

			// if ($tc_column_2_it_2) {

				$set_border_right = '';
				if ($totan_columns_t2 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
					<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
					<span>' . $tc_column_2_it_2 . '</span>
					</td>
					';
			// }

			if ($totan_columns_t2 > 2 || $totan_columns_t2 == 3) {

				$set_border_right = '';
				if ($totan_columns_t2 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_3 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 3 || $totan_columns_t2 == 4) {

				$set_border_right = '';
				if ($totan_columns_t2 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_4 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 4 || $totan_columns_t2 == 5) {

				$set_border_right = '';
				if ($totan_columns_t2 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_5 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 5 || $totan_columns_t2 == 6) {

				$set_border_right = '';
				if ($totan_columns_t2 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_6 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 6 || $totan_columns_t2 == 7) {

				$set_border_right = '';
				if ($totan_columns_t2 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_7 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 7 || $totan_columns_t2 == 8) {

				$set_border_right = '';
				if ($totan_columns_t2 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_8 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 8 || $totan_columns_t2 == 9) {

				$set_border_right = '';
				if ($totan_columns_t2 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_9 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 9 || $totan_columns_t2 == 10) {

				$set_border_right = '';
				if ($totan_columns_t2 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_10 . '</span>
						</td>
						';
			}

			if ($totan_columns_t2 > 10 || $totan_columns_t2 == 11) {

				$set_border_right = '';
				if ($totan_columns_t2 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_two_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_2 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_2_it_11 . '</span>
						</td>
						';
			}


			$table_two_row .= '<td style="width: 5%"></td>';
			$table_two_row .= '</tr>';
		}
	}

	$html .= <<<DOC
   <table cellmargin="0" cellpadding="2" style="">
	   {$table_two_row}
   </table>
DOC;

	/**
	 * end table 2
	 * how_many_columns_need_two
	 */

	/**
	 * start table 3
	 * how_many_columns_need
	 */

	$final_tv_table_3_head_title = '';
	if ($is_en_available == 'en') {
		$final_tv_table_3_head_title = get_post_meta($product_id, 'tv_table_3_head_title_en', true);
	} else {
		$final_tv_table_3_head_title = get_post_meta($product_id, 'tv_table_3_head_title', true);
	}

	if ($final_tv_table_3_head_title) {



		$html .= <<<DOC
	  <table>
		  <tr>
			  <td style="width: 5%"></td>
			  <td style="width: 90%; text-align: center; font-family: poppinsb; background-color: #B80103; color: #fff;  text-transform: uppercase; line-height: 25px; font-size: 10px; ">
				  <span style="">{$final_tv_table_3_head_title}</span>
			  </td>
			  <td style="width: 5%"></td>
		  </tr>
	  </table>
DOC;
	}

	$totan_columns_t3 = get_post_meta($product_id, 'how_many_columns_need_three', true);

	if ($totan_columns_t3 == 2) {
		$tb_width_3 = '45%';
	} elseif ($totan_columns_t3 == 3) {
		$tb_width_3 = '30%';
	} elseif ($totan_columns_t3 == 4) {
		$tb_width_3 = '22.5%';
	} elseif ($totan_columns_t3 == 5) {
		$tb_width_3 = '18%';
	} elseif ($totan_columns_t3 == 6) {
		$tb_width_3 = '15%';
	} elseif ($totan_columns_t3 == 7) {
		$tb_width_3 = '12.8%';
	} elseif ($totan_columns_t3 == 8) {
		$tb_width_3 = '11,25%';
	} elseif ($totan_columns_t3 == 9) {
		$tb_width_3 = '10%';
	} elseif ($totan_columns_t3 == 10) {
		$tb_width_3 = '9%';
	} elseif ($totan_columns_t3 == 11) {
		$tb_width_3 = '8.2%';
	}

	$table_three_row = '';
	if ($is_en_available == 'en') {

		$table_rows_en3 = get_post_meta($product_id, 'table_columns_en_three', true);

		for ($en3_i = 0; $en3_i < $table_rows_en3; $en3_i++) {

			$set_bg = '';
			if ($en3_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_three_row .= '<tr>';
			$table_three_row .= '<td style="width: 5%;"></td>';

			$tc_column_3_en_1 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_1', true);
			$tc_column_3_en_2 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_2', true);
			$tc_column_3_en_3 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_3', true);
			$tc_column_3_en_4 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_4', true);
			$tc_column_3_en_5 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_5', true);
			$tc_column_3_en_6 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_6', true);
			$tc_column_3_en_7 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_7', true);
			$tc_column_3_en_8 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_8', true);
			$tc_column_3_en_9 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_9', true);
			$tc_column_3_en_10 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_10', true);
			$tc_column_3_en_11 = get_post_meta($product_id, 'table_columns_en_three_' . $en3_i . '_tc_column_3_en_11', true);


			// if ($tc_column_3_en_1) {
				$table_three_row .= '
			 <td style="background-color: ' . $set_bg . '; width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
			 <span>' . $tc_column_3_en_1 . '</span>
			 </td>
			';
			// }

			// if ($tc_column_3_en_2) {

				$set_border_right = '';
				if ($totan_columns_t3 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
			<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
			<span>' . $tc_column_3_en_2 . '</span>
			</td>
			';
			// }

			if ($totan_columns_t3 > 2 || $totan_columns_t3 == 3) {

				$set_border_right = '';
				if ($totan_columns_t3 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_3 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 3 || $totan_columns_t3 == 4) {

				$set_border_right = '';
				if ($totan_columns_t3 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_4 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 4 || $totan_columns_t3 == 5) {

				$set_border_right = '';
				if ($totan_columns_t3 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_5 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 5 || $totan_columns_t3 == 6) {

				$set_border_right = '';
				if ($totan_columns_t3 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_6 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 6 || $totan_columns_t3 == 7) {

				$set_border_right = '';
				if ($totan_columns_t3 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_7 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 7 || $totan_columns_t3 == 8) {

				$set_border_right = '';
				if ($totan_columns_t3 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_8 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 8 || $totan_columns_t3 == 9) {

				$set_border_right = '';
				if ($totan_columns_t3 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_9 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 9 || $totan_columns_t3 == 10) {

				$set_border_right = '';
				if ($totan_columns_t3 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_10 . '</span>
				</td>
				';
			}

			if ($totan_columns_t3 > 10 || $totan_columns_t3 == 11) {

				$set_border_right = '';
				if ($totan_columns_t3 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
				<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
				<span>' . $tc_column_3_en_11 . '</span>
				</td>
				';
			}

			$table_three_row .= '<td style="width: 5%"></td>';
			$table_three_row .= '</tr>';
		}
	} else {

		$table_rows_it3 = get_post_meta($product_id, 'table_columns_it_three', true);

		for ($it3_i = 0; $it3_i < $table_rows_it3; $it3_i++) {

			$set_bg = '';
			if ($it3_i % 2 == 0) {
				$set_bg = '#f4f4f4';
			}

			$table_three_row .= '<tr>';
			$table_three_row .= '<td style="width: 5%;"></td>';

			$tc_column_3_it_1 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_1', true);
			$tc_column_3_it_2 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_2', true);
			$tc_column_3_it_3 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_3', true);
			$tc_column_3_it_4 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_4', true);
			$tc_column_3_it_5 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_5', true);
			$tc_column_3_it_6 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_6', true);
			$tc_column_3_it_7 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_7', true);
			$tc_column_3_it_8 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_8', true);
			$tc_column_3_it_9 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_9', true);
			$tc_column_3_it_10 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_10', true);
			$tc_column_3_it_11 = get_post_meta($product_id, 'table_columns_it_three_' . $it3_i . '_tc_column_3_it_11', true);


			// if ($tc_column_3_it_1) {
				$table_three_row .= '
					<td style="background-color: ' . $set_bg . '; width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px;  border-right: 1px solid #ccc;  border-bottom: 1px solid #ccc; line-height: 13px;">
					<span>' . $tc_column_3_it_1 . '</span>
					</td>
					';
			// }

			// if ($tc_column_3_it_2) {

				$set_border_right = '';
				if ($totan_columns_t3 == 2) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
					<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . '  border-bottom: 1px solid #ccc; line-height: 13px;">
					<span>' . $tc_column_3_it_2 . '</span>
					</td>
					';
			// }

			if ($totan_columns_t3 > 2 || $totan_columns_t3 == 3) {

				$set_border_right = '';
				if ($totan_columns_t3 == 3) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_3 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 3 || $totan_columns_t3 == 4) {

				$set_border_right = '';
				if ($totan_columns_t3 == 4) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_4 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 4 || $totan_columns_t3 == 5) {

				$set_border_right = '';
				if ($totan_columns_t3 == 5) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_5 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 5 || $totan_columns_t3 == 6) {

				$set_border_right = '';
				if ($totan_columns_t3 == 6) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_6 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 6 || $totan_columns_t3 == 7) {

				$set_border_right = '';
				if ($totan_columns_t3 == 7) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_7 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 7 || $totan_columns_t3 == 8) {

				$set_border_right = '';
				if ($totan_columns_t3 == 8) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_8 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 8 || $totan_columns_t3 == 9) {

				$set_border_right = '';
				if ($totan_columns_t3 == 9) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_9 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 9 || $totan_columns_t3 == 10) {

				$set_border_right = '';
				if ($totan_columns_t3 == 10) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_10 . '</span>
						</td>
						';
			}

			if ($totan_columns_t3 > 10 || $totan_columns_t3 == 11) {

				$set_border_right = '';
				if ($totan_columns_t3 == 11) {
					$set_border_right = '';
				} else {
					$set_border_right = 'border-right: 1px solid #ccc;';
				}

				$table_three_row .= '
						<td style="background-color: ' . $set_bg . ';  width: ' . $tb_width_3 . '; font-family: poppins; font-size: 8px; ' . $set_border_right . ' border-bottom: 1px solid #ccc; line-height: 13px;">
						<span>' . $tc_column_3_it_11 . '</span>
						</td>
						';
			}


			$table_three_row .= '<td style="width: 5%"></td>';
			$table_three_row .= '</tr>';
		}
	}

	$html .= <<<DOC
   <table cellmargin="0" cellpadding="2" style="">
	   {$table_three_row}
   </table>
DOC;

	/**
	 * end table 3
	 * how_many_columns_need_three
	 */

	/**
	 * start bottom description
	 */


	$table_desc_row = '';
	if ($is_en_available == 'en') {
		$total_rows_desc_en = get_post_meta($product_id, 'tv_post_extra_contents_en', true);
		$last_description_title_en = get_post_meta($product_id, 'last_description_title_en', true);
		$sro_last_description_en = get_post_meta($product_id, 'sro_last_description_en', true);

		for ($dsc_en_i = 0; $dsc_en_i < $total_rows_desc_en; $dsc_en_i++) {
			$tv_post_ex_cont_title_en = get_post_meta($product_id, 'tv_post_extra_contents_en_' . $dsc_en_i . '_tv_post_ex_cont_title_en', true);
			$tv_post_ex_cont_desc_en = str_replace(['&nbsp;', '</li>'], ['<p style="line-height: -6px; "></p>', '</li><p style="line-height: -8px; "></p>'], get_post_meta($product_id, 'tv_post_extra_contents_en_' . $dsc_en_i . '_tv_post_ex_cont_desc_en', true));

			$table_desc_row .= '<tr>';
			$table_desc_row .= '<td style="width: 5%"></td>';
			$table_desc_row .= '<td style="width: 90%">';

			$table_desc_row .= '
					<span style="font-family: poppinssemib; font-size: 10px; color: #b70202; line-height: 18px; ">' . $tv_post_ex_cont_title_en . '<br/></span>
					<span style="font-family: poppins; font-size: 9px; color: #323232; ">' . $tv_post_ex_cont_desc_en . '</span>
				';

			$table_desc_row .= '</td>';
			$table_desc_row .= '<td style="width: 5%"></td>';
			$table_desc_row .= '</tr>';
		}

		$table_desc_row .= '<tr>';
		$table_desc_row .= '<td style="width: 5%"></td>';
		$table_desc_row .= '<td style="width: 90%">';

		$table_desc_row .= '<span style="font-family: poppins; font-size: 10px; color: #323232;"><br/><br/><br/><strong>' . $last_description_title_en . '</strong></span><br/><span style="line-height: 20px; "></span><span style="font-family: poppins; font-size: 8px; color: #323232; text-align: justify; ">' . $sro_last_description_en . '</span>
				';

		$table_desc_row .= '</td>';
		$table_desc_row .= '<td style="width: 5%"></td>';
		$table_desc_row .= '</tr>';
	} else {
		$total_rows_desc_it = get_post_meta($product_id, 'tv_post_extra_contents', true);
		$last_description_title_it = get_post_meta($product_id, 'last_description_title_it', true);
		$sro_last_description_it = get_post_meta($product_id, 'sro_last_description_it', true);

		for ($dsc_i = 0; $dsc_i < $total_rows_desc_it; $dsc_i++) {
			$tv_post_ex_cont_title = get_post_meta($product_id, 'tv_post_extra_contents_' . $dsc_i . '_tv_post_ex_cont_title', true);
			$tv_post_ex_cont_desc = str_replace(['&nbsp;', '</li>'], ['<p style="line-height: -6px; "></p>', '</li><p style="line-height: -8px; "></p>'], get_post_meta($product_id, 'tv_post_extra_contents_' . $dsc_i . '_tv_post_ex_cont_desc', true));

			$table_desc_row .= '<tr>';
			$table_desc_row .= '<td style="width: 5%"></td>';
			$table_desc_row .= '<td style="width: 90%">';

			$table_desc_row .= '
					<span style="font-family: poppinssemib; font-size: 10px; color: #b70202; line-height: 18px; ">' . $tv_post_ex_cont_title . '<br/></span>
					<span style="font-family: poppins; font-size: 9px; color: #323232; ">' . $tv_post_ex_cont_desc . '</span>
				';

			$table_desc_row .= '</td>';
			$table_desc_row .= '<td style="width: 5%"></td>';
			$table_desc_row .= '</tr>';
		}

		$table_desc_row .= '<tr>';
		$table_desc_row .= '<td style="width: 5%"></td>';
		$table_desc_row .= '<td style="width: 90%">';

		$table_desc_row .= '<span style="font-family: poppins; font-size: 9px; color: #323232;"><br/><br/><br/><strong>' . $last_description_title_it . '</strong></span><br/><span style="line-height: 20px; "></span><span style="font-family: poppins; font-size: 8px; color: #323232; text-align: justify; ">' . $sro_last_description_it . '</span>
				';

		$table_desc_row .= '</td>';
		$table_desc_row .= '<td style="width: 5%"></td>';
		$table_desc_row .= '</tr>';
	}




	$html .= <<<DOC
	<br/>
	<br/>
 <table cellmargin="0" cellpadding="2" style="">
	{$table_desc_row}
 </table>
DOC;


	$pdf->writeHTML($html);
	/**
	 * @param string filename
	 * @param string mode (I/D/F/S/FI/FD/E)
	 * 			I: show PDF in brower
	 * 			D: Download pdf
	 * 			F: Store in server
	 * 			S: return as string, recommended for sending mail attachment
	 * 			FI: F + I
	 * 			FD: F + D
	 * 			E: return the document as base64 mime multi-part email attachment
	 */

	$file_name =  '_Scheda_Prodotto' . '.pdf';
	$pdf->Output($file_name, 'I');

	die;
}
