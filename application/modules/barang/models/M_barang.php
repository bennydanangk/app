<?php
class M_barang extends CI_Model {
//Confif
 function config(){
   return $this->db->get('config')->result();
 }   

 function get_data($table,$where){		
  return $this->db->get_where($table,$where)->result();
}	

function get_barang($table,$where){		
  $this->db->join('perolehan', 'barang.id_perolehan = perolehan.id_perolehan');
  $this->db->join('jenis', 'barang.id_jenis = jenis.id_jenis');
  // $this->db->join('sumber_dana', 'barang.id_sumber_dana = sumber_dana.id_sumber_dana');
  // $this->db->join('distributor', 'barang.id_distributor = distributor.id_distributor');
  // $this->db->join('user', 'barang.id_user = user.id_user');
  $this->db->join('satuan', 'barang.id_satuan = satuan.id_satuan');
  return $this->db->get_where($table,$where)->result();
}	


function get_ruang($table,$where){		
  return $this->db->get_where($table,$where)->result();
}	



function get_all($tabel) {
  return $this->db->get($tabel)->result();
}
//add Data
function input_data($data,$table){
return  $this->db->insert($table,$data);
}
function get_cek($table,$where){		
  return $this->db->get_where($table,$where);
}	
//edit Data
function edit_data($where,$data,$table){
  $this->db->where($where);
  $this->db->update($table,$data);
}

function get_state($table,$where){		
  $this->db->join('role_user', 'user.id_user = role_user.id_user');
  return $this->db->get_where($table,$where);
}	


}
?>