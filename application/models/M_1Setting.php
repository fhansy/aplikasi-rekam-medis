<?php
class M_1Setting extends CI_Model {
	// var $session_expire	= 7200;
	var $table='diagnosa';
	var $pk='id_diagnosa';

	public function getLogo()
	{
		$logo= base_url('assets/').'images/logo.png';
		return $logo;
	}
	public function Cetak()
	{
		$script =
		'<script type="text/javascript">
		  function printData()
		    {
		       var printContents = document.getElementById("printTable").innerHTML;
		       var originalContents = document.body.innerHTML;

		       document.body.innerHTML = printContents;

		       window.print();

		       document.body.innerHTML = originalContents;
		    }
		   function printData2()
		    {
		       var divToPrint=document.getElementById("printTable");
		       newWin= window.open("");
		       newWin.document.write(divToPrint.outerHTML);
		       newWin.print();
		       newWin.close();
		    }
		    function printKartu()
		    {
		    	document.window.open("http://localhost/rekap_medis/resepsionis/pasien/kartu/'.($this->M_Pasien->getMax()+1).'","_blank");

		       // window.open("http://localhost/rekap_medis/resepsionis/pasien/kartu/");
		    }
		 </script>';
			return $script;
	}
	public function insert($data){
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_penyakit', $data['id_penyakit']);
		$this->db->where('id_rekap_medis', $data['id_rekap_medis']);

		$query = $this->db->get()->row();
		if(empty($query)){
			$id = $this->db->insert($this->table, $data);
		}else{
			$id = $this->db->update($this->table, $data);
		}
		//$this->db->insert_id();
		return $id;
	}
	
	public function update($data){
		$this->db->where($this->pk, $data[$this->pk]);
		$id = $this->db->update($this->table, $data);
		return $id;
	}

	public function delete($id){
		$id = $this->db->where($this->pk,$id)->delete($this->table);
		return $id;
	}
}
