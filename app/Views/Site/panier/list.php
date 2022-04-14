<div role="main" class="main shop pb-4">

<div class="container">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb font-weight-bold text-6 justify-content-center my-5">
                <li class="text-transform-none mr-2">
                    <a href="shop-cart.html" class="text-decoration-none text-color-primary">Shopping Cart</a>
                </li>
                <li class="text-transform-none text-color-grey-lighten mr-2">
                    <a href="shop-checkout.html" class="text-decoration-none text-color-grey-lighten text-color-hover-primary">Checkout</a>
                </li>
                <li class="text-transform-none text-color-grey-lighten">
                    <a href="shop-order-complete.html" class="text-decoration-none text-color-grey-lighten text-color-hover-primary">Order Complete</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row pb-4 mb-5 panier-all">
        <div class="col-lg-8 mb-5 mb-lg-0">
         <?php 
         if(isset($panier) && !empty($panier))
         {
            $totale = (float) 0;
        ?>
            <form method="post" action="">
                <div class="table-responsive">
                    <table class="shop_table cart">
                        <thead>
                            <tr class="text-color-dark">
                                <th class="product-thumbnail" width="15%">
                                    &nbsp;
                                </th>
                                <th class="product-name text-uppercase" width="30%">
                                    Product
                                </th>
                                <th class="product-price text-uppercase" width="15%">
                                    Quantité
                                </th>
                                <th class="product-price text-uppercase" width="15%">
                                     Prix
                                </th>
                                <th class="product-price text-uppercase" width="15%">
                                     Prix Total 
                                </th>
                               
                            </tr>
                        </thead>
                        <div class='infos-del-product'></div>
                        <tbody id='panier-list-edit'>
                       <?php
                          // $item contient l'id product dinsctinct de order item
                            foreach($panier as $item)
                            {
                                // pour chaque id product de la table order items je fais une recherche du produit id qui lui correspond
                                // $product = $productModel->where("product_id", $item['product_id'])->first();
                                $product = readGetValueTabByKey($item['product_id'] , $listProduct, 'product_id') ;

                                // si n'est pas vide product on afficher les details du produit dans le panier
                                if(!empty($product))
                                {
                                    $totaleQT = $product['price']* $item['quantity'];
                                    $totale += $totaleQT;
                                    if($totale > 0)
                                    {
                                        session()->set(['totale'=>$totale]);
                                    }else {
                                        session()->set(['totale'=>"aucun produit"]);
                                    }

                        ?>
                                <tr class="cart_table_item list-product-panier" id='<?php echo $item['product_id']?>'>
                                <td class="product-thumbnail">
                                    <div class="product-thumbnail-wrapper">
                                        <button type="button" class="btn deleteProduct" data-product =<?php echo $item['product_id'];?> title="Remove Product">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type='button' class="btn editProduct" data-product =<?php echo $item['product_id'];?> title="edit Product">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="#" class="product-thumbnail-image" title="Porto Headphone">
                                            <img width="90" height="90" alt="" class="img-fluid" src="img/products/product-grey-7.jpg">
                                        </a>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="<?php echo base_url("article/details/".$product["product_id"])?>" class="font-weight-semi-bold text-color-dark text-color-hover-primary text-decoration-none"><?php echo $product['product_name']; ?></a>
                                </td>
                                <td class="product-price">
                                    <span class="amount font-weight-medium text-color-grey quant-<?php echo $item['product_id']?>"><?php  echo $item['quantity']?></span>
                                </td>
                                <td class="product-price">
                                    <span class="amount font-weight-medium text-color-grey"><?php  echo $product['price']?></span>
                                </td>
                                <td class="product-price">
                                    <span class="amount font-weight-medium text-color-grey"><?php  echo $totaleQT; ?></span>
                                </td>
                               
                            </tr>

                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-sm">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="smallModalLabel">Small Modal Title</h4>
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												</div>
												<div class="modal-body">
                                            <form  method="post" class="cart" >
											<div class="quantity quantity-lg">
												<input type="button" class="minus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="-">
												<input type="text" class="input-text qty text edit-qt-produit" title="Qty" value="1" name="quantity" min="1" step="1">
												<input type="button" class="plus text-color-hover-light bg-color-hover-primary border-color-hover-primary" value="+">
											</div>
											<button type='button' id="editQuant"  data-dismiss="modal"  class="btn btn-dark btn-modern text-uppercase bg-color-hover-primary border-color-hover-primary">Add to cart</button>
											<hr>
							               </form>	
                                           	</div>
												
												<div class="modal-footer">
													<button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
												</div>
											</div>
										</div>
									</div>
                       
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="card border-width-3 border-radius-0 border-color-hover-dark" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.row', 'padding': {'top': 85}}">
                <div class="card-body">
                    <h4 class="font-weight-bold text-uppercase text-4 mb-3">Cart Totals</h4>
                    <table class="shop_table cart-totals mb-4">
                        <tbody>
                            <tr class="cart-subtotal">
                                <td class="border-top-0">
                                    <strong class="text-color-dark">Subtotal</strong>
                                </td>
                                <td class="border-top-0 text-right">
                                    <strong><span class="amount font-weight-medium"><?php echo $totale;?> €</span></strong>
                                </td>
                            </tr>
                           
                            <tr class="total">
                                <td>
                                    <strong class="text-color-dark text-3-5">Total</strong>
                                </td>
                                <td class="text-right">
                                    <strong class="text-color-dark"><span class="amount text-color-dark text-5"><?php 
                                    echo (float)$totale;
                                    ?> €</span></strong>
                                </td>
                            </tr>
                   
                        </tbody>
                    </table>
                    <a href="<?php echo base_url("panier/confirm")?>" class="btn btn-dark btn-modern btn-block text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php            
                        } else {
                        ?>
                            <h3> Votre panier est vide </h3>
                        <?php
                        }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

                        
</div>

</div>