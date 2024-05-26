<!-- Post Items -->
<div class="mt-4">
    <?php foreach ($session['session_items'] as $sessionItem) : ?>
        <div class="card shadow mt-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" width="40" src="/img/profile/<?= $sessionItem['user']['profile_picture']; ?>">
                        <div class="ml-3">
                            <h6 class="mb-0 font-weight-bold"><?= $sessionItem['user']['full_name']; ?></h6>
                            <small><?= $sessionItem['created_at']; ?></small>
                        </div>
                    </div>

                    <div class="dropdown ml-auto text-center" style="width: 20px;">
                        <i class="fas fa-ellipsis-v w-100" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;"></i>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="dropdownMenuButton">
                            <form class="d-none" action="/pertemuan/item/<?= $sessionItem['id']; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" id="submitDelete" class="d-none" />
                            </form>

                            <label for="submitDelete" class="dropdown-item w-100 mb-0" style="cursor: pointer;" onclick="return confirm('Apakah anda yakin?')">
                                <i class="far fa-trash-alt mr-2" style="color: #c70000;"></i>
                                <span>Hapus</span>
                            </label>
                        </div>
                    </div>
                </div>

                <p class="mt-4" style="font-size: 16px;"><?= $sessionItem['text']; ?></p>

                <?php if ($sessionItem['file']) : ?>
                    <a href="/pertemuan/item/download/<?= $sessionItem['id']; ?>" class="no-style-link">
                        <div class="d-flex align-items-center bg-info text-white p-3 rounded">
                            <i class="fas fa-file-alt mr-2" style="font-size: 32px"></i>
                            <h6 class="mb-0"><?= $sessionItem['file']; ?></h6>
                        </div>
                    </a>
                <?php endif; ?>
            </div>

            <div class="card-footer bg-white">
                <?php if ($sessionItem['session_item_comments']) : ?>
                    <?php foreach ($sessionItem['session_item_comments'] as $sessionItemComment) :  ?>
                        <div class="d-flex align-items-start">
                            <img class="img-profile rounded-circle mr-2" width="32" src="/img/profile/<?= $sessionItemComment['user']['profile_picture']; ?>">

                            <div>
                                <div class="bg-light py-2 px-3 session-item-comment-containter">
                                    <h6 class="mb-0 font-weight-bold"><?= $sessionItemComment['user']['full_name']; ?></h6>
                                    <p class="mb-0"><?= $sessionItemComment['comment_text']; ?></p>
                                </div>
                                <small class="ml-3"><?= $sessionItemComment['created_at']; ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <form action="/pertemuan/item/komen/tambah" method="post">
                    <div class="form-group mb-1 <?= count($sessionItem['session_item_comments']) > 0 ? 'mt-4' : ''; ?>">
                        <div class="d-flex">
                            <input type="text" class="form-control mr-2" id="comment_text" name="comment_text" aria-describedby="emailHelp" placeholder="Tulis komentar disini..">

                            <input type="hidden" name="session_item_id" value="<?= $sessionItem['id']; ?>">

                            <button type="submit" class="button-hover text-primary">
                                <i class="fas fa-paper-plane" style="font-size: 24px;"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>