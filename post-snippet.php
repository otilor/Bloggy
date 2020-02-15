<?php foreach($posts as $post): ?>
                    <div class="col s6 md3">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h6><?php echo htmlspecialchars($post["email"]); ?></h6>
                                <ul>
                                    <?php foreach(explode(",",$post["user_posts"]) as $ind_post):?>
                                    <li>
                                        <?php echo htmlspecialchars($ind_post);?>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            
                            
                            </div>
                        </div>
                    </div>
                                    <?php endforeach; ?>