<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\Mutasi;

class Menu extends Model
{
    
    protected $table = 'ds_modul_menu';

    private static function getAll() {
		$arr = array();
		$q = Menu::where('sts_aktif', 1)
			->orderBy('id_modul_menu')
			->get();

        foreach ( $q as $row ) :
            $arr[ $row->parent_id_modul_menu ][] = $row;
        endforeach;
        return $arr;
    }

    private static function get_menu($data, $parent = 0, $arrMenu) {
		static $i = 1;
		if (isset($data[$parent])) {
			
            if ($i == 1):
				//$sess_login = $this->User->detil_login();
				$html = '<ul>';
			else:
				$html = '<ul>';
			endif;
            
			$i++;
			foreach ($data[$parent] as $v) {
				if ($v->sts_pilih == 1):
					if ( in_array($v->id_modul_menu, explode(',', $arrMenu)) ):

						$child = self::get_menu($data, $v->id_modul_menu, $arrMenu);
						if ($v->sub == 1):
							$icon = $v->parent_id_modul_menu == '0' ? '<i class="'. $v->icon_modul .'"></i>' : '';

							$html .= '<li>
							<a href="#'. $v->id_modul_menu .'">
							'. $icon .'
							<span>'. $v->nama_modul .'</span></a>';                   
						else:
							$icon = $v->parent_id_modul_menu == '0' ? '<i class="'. $v->icon_modul .'"></i>' : '';
							if ( $v->parent_id_modul_menu == '0' ) {
								$html .= '<li><a href="'. url($v->modul_menu) .'">'. $icon .'<span>'. $v->nama_modul .'</span></a>';
							} else {
								$html .= '<li><a href="'. url($v->modul_menu) .'"><span>'. $v->nama_modul .'</span></a>';
							}
						endif;
						if ($child) {
							$i--;
							$html .= $child;
						}
						$html .= '</li>';
					endif;
				elseif ($v->sts_pilih == 0):
					$child = self::get_menu($data, $v->id_modul_menu, $arrMenu);
					if ($v->sub == 1):
							$html .= '<li><a href="javascript:void(0)">
							<span>'. $v->nama_modul .'</span></a>';                   
                        else:
							if ( $v->parent_id_modul_menu == '0' ) {
								$html .= '<li><a href="'. url($v->modul_menu) .'"><span><i class="'. $v->icon_modul .'"></i></span><span>'. $v->nama_modul .'</span></a>';
							} else {
								$html .= '<li><a href="'. url($v->modul_menu) .'"><span>'. $v->nama_modul .'</span></a>';
							}
					endif;
					if ($child) {
						$i--;
						$html .= $child;
					}
					$html .= '</li>';
				endif;
			}
			$html .= "\n</ul>";
			return $html;
		} else {
			return false;
		}
	}

    public static function ShowListMenu(){
		$sess = Users::getSess();
		echo self::get_menu( self::getAll(), 0, $sess->first()->hak_akses );
	}

	private static function getMenuYgHanyaBisasts_pilih(){
		$data = array();
		$query = Menu::where('sts_pilih', 1)
			->where('sts_aktif', 1)
			->get();
		foreach ($query as $row):
			$data[$row->parent_id_modul_menu][] = $row;
        endforeach;
		return $data;
	}

	private static function daftarmenupilihan($data, $parent = 0, $arrMenu)
	{
		static $i = 1;
		if (isset($data[$parent])) {
			
			$html = "<ul>";
			$i++;
			foreach ($data[$parent] as $v) {
				$child = Menu::daftarmenupilihan($data, $v->id_modul_menu, $arrMenu);
				$html .= '<li>
				<div class="checkbox">
				  <label>
				    <input type="checkbox" name="chkmenu[]" id="chk_'. $v->id_modul_menu .'" value="'. $v->id_modul_menu .'">  ' . $v->nama_modul .'
				  </label>
				</div>';
				
				if ($child) {
					$i--;
					$html .= $child;
				}
				$html .= '</li>';
			}
			$html .= "</ul>";
			return $html;
		} else {
			return false;
		}
	}

	public static function ShowPilihanMenu()
	{
		echo Menu::daftarmenupilihan(Menu::getMenuYgHanyaBisasts_pilih(), 0, Menu::getMenuYgHanyaBisasts_pilih());
	}
}
