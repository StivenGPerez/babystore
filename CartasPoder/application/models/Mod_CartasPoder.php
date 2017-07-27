<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_CartasPoder extends CI_Model
{
  public function __construct()
  {
      parent::__construct();
      //Do your magic here
  }
  
  public function ValidarLinea($usuario)
  {
    $query = $this->db->query("SELECT LINEA FROM USUARIO@DBUGENERAL WHERE IDUSUARIO = $usuario");     
    return $query->result();
  }  

  public function CartapoderCons()
  {
    $sql_id_cartapoder = $this->db->query("SELECT (MAX(ID_CARTAPODER) + 1) ID FROM CARTAPODER");
    return $sql_id_cartapoder->result();   
  }

  public function SelectCliente($carta_cliente)
  {
    if($carta_cliente != '')
    {
      $sql_cliente = $this->db->query("SELECT NC.NIT, '('||NC.NIT||') '||NC.RAZON_SOCIAL RAZON_SOCIAL FROM NITCLIENTES NC, CLIENTES_DETALLE CL
                                       WHERE NC.NIT = CL.NIT
                                       AND NVL(CL.ESTADO_CLIENTE,'A') = 'A'
                                       AND NC.NIT <> 830023857
                                       AND (NC.RAZON_SOCIAL LIKE UPPER('%$carta_cliente%') OR NC.NIT LIKE UPPER('%$carta_cliente%'))
                                       GROUP BY NC.NIT, NC.RAZON_SOCIAL ORDER BY NC.RAZON_SOCIAL");
      return $sql_cliente->result();   
    }
    else
    {
      $sql_cliente = $this->db->query("SELECT NC.NIT, NC.RAZON_SOCIAL FROM NITCLIENTES NC, CLIENTES_DETALLE CL
                                       WHERE NC.NIT = CL.NIT
                                       AND NVL(CL.ESTADO_CLIENTE,'A') = 'A'
                                       AND NC.NIT <> 830023857
                                       AND NC.RAZON_SOCIAL LIKE '%--%'
                                       GROUP BY NC.NIT, NC.RAZON_SOCIAL ORDER BY NC.RAZON_SOCIAL");
      return $sql_cliente->result();        
    }
  }

  public function BuscarCartaspoder($carta_linea, $carta_estado, $carta_cliente, $tags_nit_agente, $carta_sucursal)
  {
    $imp = 'http:\\\\';  $imp1 = '\\'; $imp2 = '\\\\'; 

    $query = $this->db->query("SELECT  /*+ ORDERED index(CD CARTAPODER_DE_PK) index(C CARTAPODER_PK) */
                                C.ID_CARTAPODER, C.NIT,  NC.RAZON_SOCIAL,  C.NIT_AGENTE, NA.RAZON_SOCIAL NOMBRE_AGENTE, TO_DATE(C.FECHA_INICIO,'DD/MM/YYYY') FECHA_INICIO, 
                                TO_DATE(C.FECHA_FIN,'DD/MM/YYYY') FECHA_FIN, C.OBSERVACIONES, C.USUARIO_INSERCION, CASE C.ESTADO WHEN 'A' THEN 'VIGENTE'
                                                    WHEN 'I' THEN 'VENCIDO' END AS ESTADO, TO_DATE(C.FECHA_FIN,'DD/MM/YY') - TO_DATE(SYSDATE, 'DD/MM/YY') DIAS,
                                            '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_PODER RUTAPDF,
                                            '".$imp2."192.168.10.236".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_PODER RUTAPDF_OPEN, 
                                            '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_AUTORIZACION PDF_AUTO,
                                            '".$imp2."192.168.10.236".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_AUTORIZACION PDF_AUTO_OPEN, C.LINEA
                                    FROM CARTAPODER C, NITCLIENTES NC, NITCLIENTES NA, CARTAPODER_DE CD
                                    WHERE
                                         C.NIT = NC.NIT
                                     AND C.NIT_AGENTE = NA.NIT
                                     AND CD.ID_CARTAPODER = C.ID_CARTAPODER
                                     AND C.ESTADO = DECODE('$carta_estado', '-1', C.ESTADO, '$carta_estado')
                                     AND C.LINEA = DECODE('$carta_linea', '-1', C.LINEA, '$carta_linea')
                                     AND CD.SUCURSAL = DECODE('$carta_sucursal', '-1', CD.SUCURSAL, '$carta_sucursal')
                                     AND C.NIT_AGENTE = NVL('$tags_nit_agente', C.NIT_AGENTE)
                                     AND C.NIT = NVL('$carta_cliente', C.NIT)
                                     GROUP BY C.ID_CARTAPODER, C.NIT,  NC.RAZON_SOCIAL,  C.NIT_AGENTE, NA.RAZON_SOCIAL, C.FECHA_INICIO, C.FECHA_FIN, C.OBSERVACIONES, 
                                              C.USUARIO_INSERCION, C.ESTADO, ROUND(C.FECHA_FIN - SYSDATE), '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_PODER,
                                            '".$imp2."192.168.10.236".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_PODER,
                                            '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_AUTORIZACION,
                                            '".$imp2."192.168.10.236".$imp1."doc".$imp1."cartapoder".$imp1."'||CD.PDF_AUTORIZACION, C.LINEA
                                     ORDER BY C.NIT");
    if ($query->num_rows() > 0)
    {
        return $query->result(); 
    } 
  }

  public function CrearCartaspoder($carta_cliente, $carta_agente, $carta_linea, $carta_fec_ini, $carta_fec_fin, $carta_dias_vig, $carta_obs, $nombre)
  {
    
    $fec_ini_fin = date("d-m-Y", strtotime($carta_fec_ini));     // $fec_fin_fin = date("d-m-Y", strtotime($carta_fec_fin));

    $sql_agente = $this->db->query("SELECT * FROM CARTAPODER C
                                      WHERE C.NIT = $carta_cliente AND C.NIT_AGENTE = $carta_agente AND C.LINEA = '$carta_linea' AND C.ESTADO = 'A'");
    if ($sql_agente->num_rows() > 0)
    {
      return false;        
    }
    else
    {
      $sql_agente = "INSERT INTO CARTAPODER(NIT, NIT_AGENTE, FECHA_INICIO, FECHA_FIN, OBSERVACIONES, USUARIO_INSERCION, FECHA_INSERCION, LINEA)
                                      VALUES ($carta_cliente, $carta_agente, '$fec_ini_fin', '$carta_fec_fin', UPPER('$carta_obs'), UPPER('$nombre'), SYSDATE, '$carta_linea')";

      $this->db->query($sql_agente);

      if($this->db->affected_rows() > 0)
      {
        $query = $this->db->query("SELECT MAX(ID_CARTAPODER) ID FROM CARTAPODER");
          return $query->result();      
      }
      else { return false; }
    }
  }

  public function ModificarCartaspoder($carta_cliente, $carta_agente, $carta_linea, $carta_fec_ini, $carta_fec_fin, $carta_dias_vig, $carta_obs, $id_carta, $carta_estado)
  {
    $sql_agente = $this->db->query("SELECT * FROM CARTAPODER C
                                      WHERE ID_CARTAPODER = $id_carta");
    if ($sql_agente->num_rows() > 0)
    {
      $sql_agente = "UPDATE CARTAPODER 
                      SET FECHA_INICIO = '$carta_fec_ini', 
                          FECHA_FIN = '$carta_fec_fin', 
                          OBSERVACIONES = UPPER('$carta_obs'), 
                          USUARIO_MODIFICACION = UPPER('INTRAWEB'), 
                          FECHA_MODIFICACION = SYSDATE,
                          ESTADO = '$carta_estado'
                      WHERE  ID_CARTAPODER = $id_carta";

      $this->db->query($sql_agente);
      return $sql_agente->result();
    }
    else
    {
      return false;   
    }
  }

  public function CrearDeCartaspoder($sucursal, $nom_pdf, $carta_cliente, $carta_agente, $email, $carta_linea)
  {

    $sql_agente = $this->db->query("SELECT * FROM CARTAPODER_DE CD WHERE CD.PDF_PODER = 'P_'||'$nom_pdf' AND CD.LINEA = '$carta_linea' AND CD.SUCURSAL = '$sucursal'");

    if ($sql_agente->num_rows() > 0)
    {
      echo "<script> alert('La Carta ya esta en nuestro sistema con la Sucursal ".$sucursal.".'); </script>";   
      return false;        
    }
    else
    {         
      $sql_agente1 = $this->db->query("SELECT * FROM CARTAPODER C
                                        WHERE C.NIT = $carta_cliente AND C.NIT_AGENTE = $carta_agente AND C.LINEA = '$carta_linea' AND C.ESTADO = 'A'");

      if ($sql_agente1->num_rows() > 0)
      {
        if ($carta_linea == 'ML') {
          $sql_cartapoder_detalle = "INSERT INTO CARTAPODER_DE(SUCURSAL, PDF_PODER, PDF_AUTORIZACION, ID_CARTAPODER, USUARIO_INSERCION, FECHA_INSERCION, EMAIL, LINEA)
                                      VALUES ('$sucursal', 'P_'||'$nom_pdf', 'A_'||'$nom_pdf', (SELECT ID_CARTAPODER FROM CARTAPODER C
                          WHERE C.NIT = $carta_cliente AND C.NIT_AGENTE = $carta_agente AND C.LINEA = '$carta_linea' AND C.ESTADO = 'A'), UPPER('INTRAWEB'), SYSDATE, '$email', '$carta_linea')";
        }
        else
        {
          $sql_cartapoder_detalle = "INSERT INTO CARTAPODER_DE(SUCURSAL, PDF_PODER, ID_CARTAPODER, USUARIO_INSERCION, FECHA_INSERCION, EMAIL, LINEA)
                                      VALUES ('$sucursal', 'P_'||'$nom_pdf', (SELECT ID_CARTAPODER FROM CARTAPODER C
                          WHERE C.NIT = $carta_cliente AND C.NIT_AGENTE = $carta_agente AND C.LINEA = '$carta_linea' AND C.ESTADO = 'A'), UPPER('INTRAWEB'), SYSDATE, '$email', '$carta_linea')";  
        }
        $this->db->query($sql_cartapoder_detalle);
      }
      else
      {
        echo "<script> alert('No existe carta de autorizacion para asociar a las sucursales.'); </script>";   
        return false;            
      }
    }
  }

  public function ModifDeCartaspoder($sucursal, $nom_pdf, $carta_cliente, $carta_agente, $email, $carta_linea, $id_carta)
  {

    $sql_agente = $this->db->query("SELECT * FROM CARTAPODER_DE CD WHERE CD.ID_CARTAPODER = $id_carta AND CD.SUCURSAL = '$sucursal'");

    if ($sql_agente->num_rows() > 0)
    {
      if ($carta_linea == 'ML') {
        $sql_cartapoder_detalle = "UPDATE CARTAPODER_DE SET FECHA_MODIFICACION = SYSDATE, EMAIL = '$email', PDF_PODER = 'P_'||'$nom_pdf', PDF_AUTORIZACION = 'A_'||'$nom_pdf' 
                                    WHERE ID_CARTAPODER = $id_carta AND SUCURSAL = '$sucursal'";
      }
      else
      {
        $sql_cartapoder_detalle = "UPDATE CARTAPODER_DE SET FECHA_MODIFICACION = SYSDATE, EMAIL = '$email', PDF_PODER = 'P_'||'$nom_pdf' 
                                    WHERE ID_CARTAPODER = $id_carta AND SUCURSAL = '$sucursal'";  
      }
      $this->db->query($sql_cartapoder_detalle);
    }
    else
    {         
      echo "<script> alert('La Carta NO esta en nuestro sistema con la Sucursal ".$sucursal.".'); </script>";   
      return false;        
    }
  }

  public function ConsultaCartapoder($id_cartapoder)
  {
    $imp = 'http:\\\\';  $imp1 = '\\';

      $query_modf_carta = $this->db->query("SELECT  /*+ ORDERED index(CD CARTAPODER_DE_PK) */
                                CA.ID_CARTAPODER, CA.NIT, NC.RAZON_SOCIAL, CA.NIT_AGENTE, NA.RAZON_SOCIAL AGENTE, CA.LINEA, L.NOMBRE NOM_LINEA, TO_CHAR(CA.FECHA_INICIO, 'DD/MM/YYYY') FECHA_INICIO, 
                                TO_CHAR(CA.FECHA_FIN, 'DD/MM/YYYY') FECHA_FIN, CA.OBSERVACIONES, DECODE(CA.ESTADO, 'A', 'VIGENTE', 'VENCIDO') ESTADO, CD.PDF_PODER, 
                                '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CA.NIT||'-'||CA.NIT_AGENTE||'.pdf', CD.EMAIL,
                                TO_NUMBER(
                                    ((TO_DATE(CA.FECHA_INICIO, 'dd/mm/yyyy hh:mi') - TO_DATE(CA.FECHA_FIN, 'dd/mm/yyyy hh:mi') )*-1)
                                    - ((TO_DATE(CA.FECHA_INICIO, 'dd/mm/yyyy hh:mi') - TO_DATE(SYSDATE, 'dd/mm/yyyy hh:mi') )*-1) ) DIAS_VIGEN,
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COBOG') SUCBOG, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COCLO') SUCCLO, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COMDE') SUCMDE, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COCTG') SUCCTG, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COBUN') SUCBUN, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COBAQ') SUCBQA, 
                                    (SELECT SUCURSAL FROM CARTAPODER_DE WHERE ID_CARTAPODER  = '$id_cartapoder' AND SUCURSAL = 'COSMR') SUCSMR                                     
                                
                                FROM CARTAPODER CA
                                INNER JOIN CARTAPODER_DE CD ON CD.ID_CARTAPODER = CA.ID_CARTAPODER
                                INNER JOIN LINEAS L ON L.LINEA = CA.LINEA
                                INNER JOIN NITCLIENTES NC ON NC.NIT = CA.NIT
                                INNER JOIN NITCLIENTES NA ON NA.NIT = CA.NIT_AGENTE
                                WHERE CA.ID_CARTAPODER  = '$id_cartapoder'
                                
                              GROUP BY  CA.ID_CARTAPODER, CA.NIT, NC.RAZON_SOCIAL, CA.NIT_AGENTE, NA.RAZON_SOCIAL, CA.LINEA, L.NOMBRE, TO_CHAR(CA.FECHA_INICIO, 'DD/MM/YYYY'), 
                                        TO_CHAR(CA.FECHA_FIN, 'DD/MM/YYYY'), CA.OBSERVACIONES, DECODE(CA.ESTADO, 'A', 'VIGENTE', 'VENCIDO'), CD.PDF_PODER, 
                                        '".$imp."192.168.10.236:7780".$imp1."doc".$imp1."cartapoder".$imp1."'||CA.NIT||'-'||CA.NIT_AGENTE||'.pdf', CD.EMAIL,
                                        TO_NUMBER(((TO_DATE(CA.FECHA_INICIO, 'dd/mm/yyyy hh:mi') - TO_DATE(CA.FECHA_FIN, 'dd/mm/yyyy hh:mi') )*-1)
                                        - ((TO_DATE(CA.FECHA_INICIO, 'dd/mm/yyyy hh:mi') - TO_DATE(SYSDATE, 'dd/mm/yyyy hh:mi') )*-1) )");

    if($query_modf_carta != true)
    {
      return false;
    }
    else
    {
      return $query_modf_carta->result();
    }
  }

  public function ActualizarCarta()
  {

    $sql_cartas_a_inactivar = $this->db->query("SELECT (TO_DATE(C.FECHA_FIN,'DD/MM/YY') - TO_DATE(SYSDATE, 'DD/MM/YY')) DIAS_VIGENCIA, C.NIT, NC.RAZON_SOCIAL, C.NIT_AGENTE, 
                                                  NC.RAZON_SOCIAL RAZON_SOCIAL_AGENTE, C.LINEA, TO_CHAR(C.FECHA_INICIO,'DD-MM-YYYY') FECHA_INICIO, TO_CHAR(C.FECHA_FIN,'DD-MM-YYYY') FECHA_FIN
                                                  FROM CARTAPODER C 
                                                  INNER JOIN NITCLIENTES NC ON C.NIT = NC.NIT 
                                                  INNER JOIN NITCLIENTES NC1 ON C.NIT_AGENTE = NC1.NIT 
                                                  WHERE (TO_DATE(FECHA_FIN,'DD/MM/YY') - TO_DATE(SYSDATE, 'DD/MM/YY')) < 30 AND ESTADO = 'A'");

      if($sql_cartas_a_inactivar != true)
      {
        return false;
      }
      else
      {
        return $sql_cartas_a_inactivar->result();
        //$inactivar_cartas = $this->db->query("UPDATE CARTAPODER SET ESTADO = 'I' WHERE (TO_DATE(FECHA_FIN,'DD/MM/YY') - TO_DATE(SYSDATE, 'DD/MM/YY')) < 0 AND ESTADO = 'A'");
      }
  }
}
/* End of file mod_login.php */
/* Location: ./application/models/mod_login.php */