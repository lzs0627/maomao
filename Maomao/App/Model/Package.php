<?php
namespace Maomao\App\Model;

use Maomao\Core\Model\Base as Model_Base;

class Package extends Model_Base {


	public function get_list_by_code ($code) {

		$this->select(array('*'));
		$this->from('s_package');
		$this->where(array('packageid <'=>100));

		return $this->execute();

	}


}