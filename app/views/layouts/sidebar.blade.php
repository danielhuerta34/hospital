 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="../../index3.html" class="brand-link text-center" style="background-color:#34495e;">
         <img src="{{ base_url }}/theme/img/logo.png" alt="AdminLTE Logo" width="70">
         <span class="brand-text font-weight-light"></span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ base_url }}{{ $_SESSION['usuarios'][0]->avatar }}" class="img-circle avatar elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block nombre_usuario">{{ $_SESSION['usuarios'][0]->nombre }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="{{ base_url }}/home/consulta" class="nav-link <?php if (Ruta::Url() == "home/consulta") {
                                                                                echo "active";
                                                                            } ?>">
                         <i class="nav-icon fas fa-user-md"></i>
                         <p>Consulta</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ base_url }}/home/especialistas" class="nav-link <?php if (Ruta::Url() == "home/especialistas") {
                                                                                        echo "active";
                                                                                    } ?>">
                         <i class="nav-icon fas fa-user-md"></i>
                         <p>Especialistas</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ base_url }}/home/todos_los_pacientes" class="nav-link <?php if (Ruta::Url() == "home/todos_los_pacientes") {
                                                                                            echo "active";
                                                                                        } ?>">
                         <i class="nav-icon fas fa-user-injured"></i>
                         <p>Paciente</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ base_url }}/home/usuarios" class="nav-link <?php if (Ruta::Url() == "home/usuarios") {
                                                                                echo "active";
                                                                            } ?>">
                         <i class="nav-icon fas fa-users"></i>
                         <p>Usuarios</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ base_url }}/home/perfil&id={{ $_SESSION['usuarios'][0]->id_usuario }}" class="nav-link <?php if (Ruta::Url() == "home/perfil") {
                                                                                                                            echo "active";
                                                                                                                        } ?>">
                         <i class="nav-icon fas fa-user"></i>
                         <p>Perfil</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ base_url }}/login/logout" class="nav-link">
                         <i class="nav-icon fas fa-sign-out-alt"></i>
                         <p>Salir</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>