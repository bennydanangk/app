<?php
class M_Pengguna extends CI_Model {
//Confif
 function config(){
   return $this->db->get('config')->result();
 }   

 function get_data($table,$where){		
  $this->db->join('ruang', 'ruang.id_ruang = user.id_ruang');
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



}
?>