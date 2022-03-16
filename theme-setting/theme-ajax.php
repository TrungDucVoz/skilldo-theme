<?php
function theme_ajax_product_search( $ci, $model ) {

	$result['message'] 	= 'Không tìm thấy.';

	$result['status'] 	= 'error';

	if(InputBuilder::post()) {

		$keyword = Str::clear(InputBuilder::post('keyword') );

		$objects =  Product::gets( array(
			'where' 		=> array('public' => 1, 'trash' => 0 ),
			'params'		=> array('limit' => 5),
			'where_like' 	=> array( 'title' => array($keyword) ),
		) );

		$result['data'] = '';

		if( have_posts($objects) ) {
            $result['status'] 	= 'success';
			$result['data'] = '<div class="product-slider-vertical">';
			foreach ($objects as $object) {
				$result['data'] .= scmc_template( 'loop/item_product_vertical', array('val' => $object), true );
			}
			$result['data'] .= '</div>';
		}
		else {

			$result['data'] = '<div class="result-msg no-result">Không có kết quả tìm kiếm</div>';
		}

	}

	echo json_encode($result);
}
Ajax::client('theme_ajax_product_search');

function theme_ajax_contact_send($ci, $model) {

    $result['message'] 	= 'Gửi thông tin không thành công.';

    $result['status'] 	= 'error';

    if( InputBuilder::post()) {

        $name       = trim(InputBuilder::Post('name'));
        if(empty($name)) {
            $result['message'] 	= __('Họ tên không được để trống');
            echo json_encode($result);
            return false;
        }

        $email      = trim(InputBuilder::Post('email'));
        if(empty($email)) {
            $result['message'] 	= __('Email không được để trống');
            echo json_encode($result);
            return false;
        }

        $phone      = trim(InputBuilder::Post('phone'));
        if(empty($phone)) {
            $result['message'] 	= __('Ghi chú không được để trống');
            echo json_encode($result);
            return false;
        }

        $content    = trim(InputBuilder::Post('content'));

        $template = '
            <p>Họ tên: <strong>'.$name.'</strong></p>
			<p>Email: <strong>'.$email.'</strong></p>
			<p>Phone: <strong>'.$phone.'</strong></p>
			<p>Ghi chú: <strong>'.$content.'</strong></p>
        ';

        $error = EmailHandler::send($template, $name.' đã yêu cầu liên hệ từ '.Url::base(), [
            'name' => $name,
            'from' => Option::get('contact_mail'),
            'address'   => Option::get('contact_mail'),
        ]);

        if($error == true) {
            $result['message'] 	= 'Gửi thông tin liên hệ thành công.';
            $result['status'] 	= 'success';
        }
    }

    echo json_encode($result);

    return false;
}
Ajax::client('theme_ajax_contact_send');
