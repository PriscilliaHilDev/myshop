
<div role="main" class="main shop pt-4">

<div class="container">

<div class="masonry-loader masonry-loader-showing">
    <div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">
  
    <div class="col-lg-12">
    <div class="row">

    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="smallModalLabel">Small Modal Title</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body">
													<p class='name_article'> </p>
												</div>
												
												<div class="modal-body">
													<a class='btn btn-default' href='<?php echo base_url('panier') ?>'> Voir mon panier </a>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
    <!-- debut prduit-->
    <?php 
    if(isset($products) && !empty($products))
    {
        foreach($products as $product)
        {
            // $sousCat = $modelSousCat->where('sous_categorie_id', $product['sous_categorie_id'])->first();
           // afficher les sous categorie de chaque produits
            $sousCat = readGetValueTabByKey($product['sous_categorie_id'] , $listSousCat, 'sous_categorie_id') ;
            if(empty($sousCat))
            {
                $sousCat['sous_categorie_name'] = "autres"; 
            }
    ?>
                            <div class="col-12 col-sm-6 col-lg-3">

                <div class="product mb-0">
                    <div class="product-thumb-info border-0 mb-3">
                    <?php if(session()->get('userID') && $request->getCookie('idUser') || session()->get('userID') || $request->getCookie('idUser')) 
                {
                ?>
                      <div class="addtocart-btn-wrapper">
													<a id="addPanier" data-article = '<?php echo $product['product_name']; ?>' data-ref="<?php echo $product['product_id'];?>" class="text-decoration-none addtocart-btn" data-tooltip data-original-title="Add to Cart">
														<i class="icons icon-bag"></i>
													</a>
												</div>
                        <?php
                }
                ?>
                        <a href="ajax/shop-product-quick-view.html" class="quick-view text-uppercase font-weight-semibold text-2">
                        </a>
                        <?php if(isset($product["main_image"]) && !empty($product["main_image"])){ ?>
                                <a href="<?php echo base_url("article/details/".$product["product_id"])?>">
                            <div class="product-thumb-info-image div-img">
                                <img alt="" class="img-fluid taille-img" src ="<?php echo '/uploads/'.$product["main_image"] ?>">
                            </div>
                           </a>
                            <?php
                             }else {
                            ?>
                            <a href="<?php echo base_url("article/details/".$product["product_id"])?>">
                            <div class="product-thumb-info-image div-img">
                                <img alt="" class="img-fluid taille-img" src="/images/default.png">
                            </div>
                           </a>
                            <?php
                             }
                             ?>
                        
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="#" class="d-block text-uppercase text-decoration-none text-color-default text-color-hover-primary line-height-1 text-0 mb-1"><?php echo $sousCat['sous_categorie_name'];?></a>
                            <h3 class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0"><a href="shop-product-sidebar-right.html" class="text-color-dark text-color-hover-primary">											
                            <?php echo $product['product_name']; ?>
                            </a></h3>
                        </div>
                        <!-- <a href="#" class="text-decoration-none text-color-default text-color-hover-dark text-4"><i class="far fa-heart"></i></a> -->
                    </div>
                    <div title="Rated 5 out of 5">
                        <input type="text" class="d-none" value="5" title="" data-plugin-star-rating data-plugin-options="{'displayOnly': true, 'color': 'default', 'size':'xs'}">
                    </div>
                    <p class="price text-5 mb-3">
                        <span class="sale text-color-dark font-weight-semi-bold"><?php echo $product['price']; ?> €</span>
                        <!-- <span class="amount">$289,00 </span> -->
                    </p>
                </div>
            </div>

    <?php

        }
    } else {

    ?>
    
     <h4> Oups il n'y a pas ce type de produit pour cette categorie </h4>
    <?php 
    }
    
    ?>
    
        
        <!--pagination-->	
        </div>
        </div>
        <?php if(!empty($products)){?>
        <div class="row mt-4">
            <div class="col">
<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <?php if ($pager->hasPrevious()) : ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
          <span aria-hidden="true"><?= lang('Pager.first') ?></span>
        </a>
      </li>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
          <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
        </a>
      </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
      <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a class="page-link" href="<?= $link['uri'] ?>">
          <?= $link['title'] ?>
        </a>
      </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
          <span aria-hidden="true"><?= lang('Pager.next') ?></span>
        </a>
      </li>
      <li class="page-link" class="page-item">
        <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
          <span aria-hidden="true"><?= lang('Pager.last') ?></span>
        </a>
      </li>
    <?php endif ?>
  </ul>
</nav>            </div>
        </div>
        <?php }?>
        </div>
        
       
    </div>

</div>

</div>
