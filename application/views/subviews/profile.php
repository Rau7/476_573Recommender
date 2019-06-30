<div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section" style="padding-top:90px; padding-bottom:40px; background-color:#ebc175">
                            <div class="section_wrapper clearfix">
                                <div class="items_group clearfix">
                                    <!-- One full width row-->
                                    <div class="column one column_fancy_heading">
                                        <div class="fancy_heading fancy_heading_icon">
                                            <h2 class="title">Profile</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section" style="padding-top:60px; padding-bottom:20px; background-color:#fff">
                            <div class="section_wrapper clearfix">
                                <div class="items_group clearfix">
                                    <!-- One Second (1/2) Column -->
                                    
                                    <!-- One Second (1/2) Column -->
                                    <div class="column one">
                                        <div class="column_attr" style="text-align: center;">
                                            <h2 style="margin-bottom: 7px; margin-top: 15px;">Kullanıcı : <?php echo $userInfo['admin_name']; ?></h2>
                                            <hr class="no_line hrmargin_b_20" />
                                        </div>
                                    </div>
                                    <!-- Page devider -->
                                    <!-- One full width row-->
                                    <div class="column one column_divider" style="margin-top: 50px;">
                                        <hr class="no_line" />
                                    </div>
                                    <div class="column one">
                                        <div class="column one-second">
                                            <div class="fancy_heading fancy_heading_icon">
                                            <h2 class="title" style="font-size: 40px;">Okunan Kitaplar</h2>
                                            <?php if(empty($real_reading)){ ?>
                                            <h1 style="margin-top: 50px;"><i>Listelenecek kitap bulunamamıştır</i></h1>
                                            <?php } else{ ?>
                                            <table class="table table-striped">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col">#</th>
                                                      <th scope="col">Kitap Adı</th>
                                                      <th scope="col">Kitap Yazarı</th>
                                                      <th scope="col">Kitap Türü</th>
                                                      <th scope="col">Kitap Yılı</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <?php $count=1; ?>
                                                    <?php foreach ($real_reading as $reads) { ?>
                                                    <tr>
                                                     <th scope="row"><?php echo $count; ?></th>
                                                      <td><a style="text-decorations:none; color:inherit;" href="http://localhost/bookstore/index.php/Profile/recommendation/<?php echo $reads['book_id']; ?>"><?php echo $reads['book_name']; ?></a></td>
                                                      <td><a style="text-decorations:none; color:inherit;" href="http://localhost/bookstore/index.php/Profile/recommendation/<?php echo $reads['book_id']; ?>"><?php echo $reads['book_author']; ?></a></td>
                                                      <td><a style="text-decorations:none; color:inherit;" href="http://localhost/bookstore/index.php/Profile/recommendation/<?php echo $reads['book_id']; ?>"><?php echo $reads['book_genre']; ?></a></td>
                                                      <td><a style="text-decorations:none; color:inherit;" href="http://localhost/bookstore/index.php/Profile/recommendation/<?php echo $reads['book_id']; ?>"><?php echo $reads['book_year']; ?></a></td>
                                                    </tr>
                                                    <?php $count++; ?>
                                                    <?php } ?>
                                                  </tbody>
                                                </table>
                                                <?php } ?>
                                                <a href="http://localhost/bookstore/index.php/Profile/add_book_form">
                                                <button style="margin-top: 15px;">Kitap Ekle</button>
                                                </a>
                                        </div>
                                        </div>
                                        <div class="column one-second">
                                            <div class="fancy_heading fancy_heading_icon">
                                            <h2 class="title" style="font-size: 40px;">Okunacak Kitaplar</h2>
                                            <?php if(empty($real_future)){ ?>
                                            <h1 style="margin-top: 50px;"><i>Listelenecek kitap bulunamamıştır</i></h1>
                                            <?php } else{ ?>
                                             <form action="<?php echo MAIN; ?>Profile/add_futuretoread_book" method='POST' enctype="multipart/form-data"> 
                                           <table class="table table-striped">
                                                      <tr>
                                                      <th>&nbsp;</th>
                                                      <th scope="col">#</th>
                                                      <th scope="col">Kitap Adı</th>
                                                      <th scope="col">Kitap Yazarı</th>
                                                      <th scope="col">Kitap Türü</th>
                                                      <th scope="col">Kitap Yılı</th>
                                                      </tr>
                                                      <?php $counter=1; ?>
                                                      <?php foreach ($real_future as $recc) { ?>
                                                      <tr>
                                                          <td><input type="checkbox" name="<?php echo $recc['book_id']; ?>" /></td>
                                                          <td><?php echo $counter; ?></td>
                                                          <td><?php echo $recc['book_name']; ?></td>
                                                          <td><?php echo $recc['book_author']; ?></td>
                                                          <td><?php echo $recc['book_genre']; ?></td>
                                                          <td><?php echo $recc['book_year']; ?></td>
                                                      </tr>
                                                      <?php $counter++; ?>
                                                      <?php } ?>
                                                  </table>
                                                  <br />
                                                  <!--<input type="submit" name="Ekle" value="Okunanlara Ekle" class="button" style="padding: 3px 6px; font-size: 20px;">-->
                                                </form>
                                            <?php } ?>    
                                        </div>
                                        </div>
                                    </div>

                                    <div class="column one column_divider">
                                        <hr class="no_line" />
                                    </div>
                                    
 

                                </div>
                            </div>
                        </div>
                        <div class="column one column_divider" style="margin-top: 50px;">
                                        <hr class="no_line" />
                                    </div>
                                    <div class="column one column_divider">
                                        <hr class="no_line" />
                                    </div>
                                    <div class="column one column_divider">
                                        <hr class="no_line" />
                                    </div>

                                                           
                        <div class="section the_content">
                            <div class="section_wrapper">
                                <div class="the_content_wrapper"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>