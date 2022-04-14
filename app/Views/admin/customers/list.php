<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
				<div class="sidebar-header">
					<div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
						
							<ul class="nav nav-main">
								<li>
									<a class="nav-link" href="http://shopping/admin">
										<i class="bx bx-home-alt" aria-hidden="true"></i>
										<span>Dashboard</span>
									</a>                        
								</li>
														 
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="http://shopping/admin/category">
												- Catégories
											</a>
										</li>
										<li class="nav-active">
											<a class="nav-link" href="http://shopping/admin/sousCategory">
												- Sous-catégories
											</a>
										</li>
										<li class="nav-active">
											<a class="nav-link" href="http://shopping/admin/customers">
												- Utilisateurs
											</a>
										</li>
									
									</ul>
								</li>
							   </ul>
							   </nav>
			</aside>
			<!-- end: sidebar -->
				<!-- end: sidebar -->
				
				<section role="main" class="content-body content-body-modern mt-0">
					<header class="page-header page-header-left-inline-breadcrumb">
						<h2 class="font-weight-bold text-6">Dashboard</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">
								<li><span>Home</span></li>
								<li><span>eCommerce</span></li>
								<li><span>Customers</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="row">
						<div class="col">
							
							<div class="card card-modern">
								<div class="card-body">
									
								<table class="table table-ecommerce-simple table-striped mb-0" style="min-width: 550px;">
											<thead>
												<tr>
													<th width="3%"><input type="checkbox" name="select-all" class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
													<th width="8%">ID</th>
													<th width="28%">Name</th>
													<th width="23%">Email</th>
													<th width="38%">Creer le</th>
												</tr>
											</thead>
											<tbody>
												<?php if(isset($usersAll) && !empty($usersAll))
												{
													foreach($usersAll as $user)
													{

												?>
                                                <tr>
													<td width="30"><input type="checkbox" name="checkboxRow1" class="checkbox-style-1 p-relative top-2" value="" /></td>
													<td class='profile-info profile-info-no-role'><a href="<?php echo base_url('admin/customers/orders/'.$user['user_id']) ?>"><strong><?php echo $user['user_id'];?></strong></a></td>
													<td><a href="#"><strong><?php echo $user['pseudo'];?></strong></a></td>
													<td><a href="#"><strong><?php echo $user['email'];?></strong></a></td>
													<td><a href="#"><strong><?php echo $user['create_at'];?></strong></a></td>
												
													</tr>
												<?php
													}
												
												} else {
												?>
													
											</tbody>
											</table>

												<tr><h4> Aucuns utilisateurs pour le moment </h4></tr>
												<?php
												}
												?>
											
		
								
									</table>
									
								</div>
							</div>
							<div>
								<?php echo $pager->links();?>
								</div>
						</div>
					</div>


					<!-- end: page -->
				</section>
			</div>

		

		</section>
        