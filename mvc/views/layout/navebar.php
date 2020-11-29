        
<div id="wrapper">
  <nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <h3 class="customTXT headerDiv middie-position"><img style="height:27px; width:27px;" src="<?php echo base_url( getSite()->site_logo);?>" />&nbsp;<?php echo getSite()->name;?></h3>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <!-- FOR ADMIN  -->
        <?php if($this->session->userdata('access') == 1) { ?>
        <li><a href="<?php echo base_url();?>dashboard">Escritorio<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informacion <span class="caret"></span><span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-folder-open"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
            <li><a href="<?php echo base_url('students/student');?>"><span class="pull-right hidden-xs glyphicon"><i class="fa fa-users"></i></span>Info Estudiante</a></li>
            <li><a href="<?php echo base_url('teachers/teacher');?>"><span class="pull-right hidden-xs glyphicon glyphicon-user"></span>Info Profesores</a></li>
            <li><a href="<?php echo base_url('subject/subject');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Info Asunto</a></li>
            <li><a href="<?php echo base_url('department/department');?>"><span class="pull-right hidden-xs glyphicon glyphicon-tags"></span>Info Area</a></li>
          </ul>
        </li>
        <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Procesos <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-flask"></i></a>
         <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
           <li><a href="<?php echo base_url('assignsemester/assign_semester');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-book"></i></span>Asignar semestre</a></li>
           <li><a href="<?php echo base_url('assignSubjectCus/assign_subject_cus');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-book"></i></span>Asignar asunto</a></li>
           <li><a href="<?php echo base_url('assignteacher/assign_teacher');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-user"></i></span>Asignar maestros</a></li>
           <li><a href="<?php echo base_url('waiver/waivers');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-pencil-square-o"></i></span>Proceso de renuncia</a></li>
         </ul>
       </li>

       <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Libreria <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-book"></i></a>
         <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
           <li ><a href="<?php echo base_url('library/members');?>"><span class="pull-right hidden-xs"><i class="fa fa-users"></i></span>Miembros</a></li>
           <li ><a href="<?php echo base_url('library/pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Libros</a></li>
           <li><a href="<?php echo base_url('library/book_issue_pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Emisión y devolución</a></li>
         </ul>
       </li>

       
       <li >
        <a href="<?php echo base_url('notice/notice');?>">Noticia&nbsp;<?php if ( noticeCounter() != 0){ echo "<sup>".noticeCounter()."</sup>";}?>
         <span style="font-size:17px;" class="pull-right hidden-xs showopacity">
          <i class="fa fa-envelope-o"></i>
        </span>
      </a>
    </li>
    <li ><a href="<?php echo base_url('semesterArchive/semester_archive');?>">Archivo del semestre<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-file-archive-o"></i></span></a></li>
    <li ><a href="<?php echo base_url('resultArchive/resultArchive');?>">Archivo de resultados <span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-graduation-cap"></i></span></a></li>
    <li ><a href="<?php echo base_url('report/report');?>">Reporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-clipboard"></i></span></a></li>
    <li ><a href="<?php echo base_url('transport/pages');?>">Transporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-bus"></i></span></a></li>
    <li ><a href="<?php echo base_url('settings/settings_data');?>">Configuraciones<span style="font-size:17px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-cog"></span></a></li>

    <!-- FOR STUDENT -->
    <?php } elseif($this->session->userdata('access') == 4) { ?>
    <li><a href="<?php echo base_url('dashboard');?>">Escritorio<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a></li>
    <li ><a href="<?php echo base_url('notice/studentNotice');?>">Noticia&nbsp;<?php if ( noticeCounter() != 0){ echo "<sup>".noticeCounter()."</sup>";}?><span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-envelope-o"></i></span></a></li>
    <li><a href="<?php echo base_url('marksheet/marksheet');?>">Hoja de marcas<span style="font-size:17px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span></a></li>

    <li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cursos <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-book"></i></a>
     <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
       <li ><a href="https://drive.google.com/drive/folders/14-t6dv0ovgFauGAzpmvhMY70d45L7Js4?usp=sharing" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-users"></i></span>Enfermeria Tecnica</a></li>
       <li ><a href="https://drive.google.com/drive/folders/1lkSP-PG9p6f-44Y-YjveBbPUl35N-2xM?usp=sharing" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Industrias alimentarias</a></li>
       <li><a href="https://drive.google.com/drive/folders/19xvNEPMHqyK5ZpY9AHdNtnQpJEgYFxtn?usp=sharing" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Mecanica Atomotriz</a></li>
       <li><a href="https://drive.google.com/drive/folders/1yc649KcrpOg6ejgAF-hdHs70_yQ0kfSq?usp=sharing" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Producción Agropecuaria</a></li>
       <li><a href="https://drive.google.com/drive/folders/1mGF-J39xq24AI6iVc7pdwLPmhsLYK8v9?usp=sharing" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Secretariado Ejecutivo</a></li>
     </ul>
   </li>

    <li><a href="<?php echo base_url('pre_reg/pre_registration');?>">Registro<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-check-square-o"></span></a></li>
    <li ><a href="<?php echo base_url('transport/pages');?>">Transporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-bus"></i></span></a></li>
    <li ><a href="<?php echo base_url('library/library_details');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Libreria</a></li>
    <li><a href="<?php echo base_url('changepassword/changepassword');?>">Cambiar Contraseña<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-exchange"></span></a></li>
    <!-- FOR TEACHERS  -->
    <?php } elseif($this->session->userdata('access') == 3) { ?>
    <li><a href="<?php echo base_url('dashboard');?>">Escritorio<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a></li>
    <li ><a href="<?php echo base_url('notice/teachersNotice');?>">Noticia&nbsp;<?php if ( noticeCounter() != 0){ echo "<sup>".noticeCounter()."</sup>";}?><span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-envelope-o"></i></span></a></li>
    <li><a href="<?php echo base_url('teachers_overview/overview');?>">Visión general<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-eye"></span></a></li>

    <li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cursos <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-book"></i></a>
     <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
       <li ><a href="<?php echo base_url('cursos/create');?>" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-users"></i></span>Crear Curso</a></li>
       <li ><a href="<?php echo base_url('cursos/edit');?>" target="_blank"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Editar Curso</a></li>
     </ul>
   </li>

    <li style="display:none;"><a href="<?php echo base_url('transport/pages');?>">Transporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-bus"></i></span></a></li>



    <li><a href="<?php echo base_url('changepassword/changepassword');?>">Cambiar Contraseña<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-exchange"></span></a></li>



    <!-- FOR AUTHORITY  -->
    <?php } elseif($this->session->userdata('access') == 2) { ?>
    <li><a href="<?php echo base_url();?>dashboard">Escritorio<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Informacion <span class="caret"></span><span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-folder-open"></span></a>
      <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
        <li><a href="<?php echo base_url('students/student');?>"><span class="pull-right hidden-xs glyphicon"><i class="fa fa-users"></i></span>Info Estudiante</a></li>
        <li><a href="<?php echo base_url('teachers/teacher');?>"><span class="pull-right hidden-xs glyphicon glyphicon-user"></span>Info Profesor</a></li>
        <li><a href="<?php echo base_url('subject/subject');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Info Asunto</a></li>
        <li><a href="<?php echo base_url('department/department');?>"><span class="pull-right hidden-xs glyphicon glyphicon-tags"></span>Info Area</a></li>
      </ul>
    </li>
    <li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Procesos <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-flask"></i></a>
     <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
       <li><a href="<?php echo base_url('assignsemester/assign_semester');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-book"></i></span>Asignar semestre</a></li>
       <li><a href="<?php echo base_url('assignSubjectCus/assign_subject_cus');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-book"></i></span>Asignar asunto</a></li>
       <li><a href="<?php echo base_url('assignteacher/assign_teacher');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-user"></i></span>Asignar maestros</a></li>
       <li><a href="<?php echo base_url('waiver/waivers');?>"><span class="pull-right hidden-xs"><i style="font-size:17px;" class="fa fa-pencil-square-o"></i></span>Proceso de renuncia</a></li>
     </ul>
   </li>
   <li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Libreria <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-book"></i></a>
     <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
       <li ><a href="<?php echo base_url('library/members');?>"><span class="pull-right hidden-xs"><i class="fa fa-users"></i></span>miembros</a></li>
       <li ><a href="<?php echo base_url('library/pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Libros</a></li>
       <li><a href="<?php echo base_url('library/book_issue_pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Emisión y devolución</a></li>
     </ul>
   </li>

   


   <li ><a href="<?php echo base_url('notice/notice');?>">Noticia&nbsp;<?php if ( noticeCounter() != 0){ echo "<sup>".noticeCounter()."</sup>";}?><span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-envelope-o"></i></span></a></li>
   <li ><a href="<?php echo base_url('semesterArchive/semester_archive');?>">Archivo del semestre<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-file-archive-o"></i></span></a></li>
   <li ><a href="<?php echo base_url('resultArchive/resultArchive');?>">Archivo de resultados <span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-graduation-cap"></i></span></a></li>
   <li ><a href="<?php echo base_url('report/report');?>">Reporte <span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-clipboard"></i></span></a></li>
   <li ><a href="<?php echo base_url('transport/pages');?>">Transporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-bus"></i></span></a></li>
   <li><a href="<?php echo base_url('changepassword/changepassword');?>">Cambiar Contraseña<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-exchange"></span></a></li>
   <!-- FOR LIBRARIAN -->
    <?php } elseif($this->session->userdata('access') == 5) { ?>
    <li><a href="<?php echo base_url();?>dashboard">Escritorio<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a></li>
    <li ><a href="<?php echo base_url('notice/teachersNotice');?>">Noticia&nbsp;<?php if ( noticeCounter() != 0){ echo "<sup>".noticeCounter()."</sup>";}?><span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-envelope-o"></i></span></a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Libreria <span class="caret"></span><i style="font-size:18px;" class=" pull-right hidden-xs fa fa-book"></i></a>
      <ul class="dropdown-menu forAnimate" role="menu" style="background-color:#384f66;">
        <li ><a href="<?php echo base_url('library/members');?>"><span class="pull-right hidden-xs"><i class="fa fa-users"></i></span>miembros</a></li>
        <li ><a href="<?php echo base_url('library/pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-book"></i></span>Libros</a></li>
        <li><a href="<?php echo base_url('library/book_issue_pages');?>"><span class="pull-right hidden-xs"><i class="fa fa-exchange"></i></span>Emisión y devolución</a></li>
      </ul>
    </li>
    <li ><a href="<?php echo base_url('transport/pages');?>">Transporte<span style="font-size:17px;" class="pull-right hidden-xs showopacity"><i class="fa fa-bus"></i></span></a></li>
    <li><a href="<?php echo base_url('changepassword/changepassword');?>">Cambiar Contraseña<span style="font-size:17px;" class="pull-right hidden-xs showopacity fa fa-exchange"></span></a></li>

   <?php } ?>
 </ul>
 <!--close  For Authority user access  -->

 
 <ul class="nav navbar-nav navbar-right navbar-user" style="margin-right:0px;">
  <li class="dropdown user-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <?php getLoginUserName(); ?>&nbsp;<b class="caret"></b>&nbsp;&nbsp;<span style="font-size:17px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span>
    </a>
    <ul class="dropdown-menu" >
     <li><a href="<?=base_url('login/logout')?>"><span style="font-size:17px;" class="pull-right hidden-xs showopacity glyphicon  glyphicon-off"></span>sALIR</a></li>
   </ul>
 </li>
</ul>
</div>
</nav>
<br><br>
<div id="page-wrapper">
