<!-- Post Items -->
<div>
    <?php foreach ($session['session_items'] as $sessionItem) : ?>
        <div id="<?= $sessionItem['code']; ?>" class="card shadow mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="img-profile rounded-circle" width="40" src="/img/profile/<?= $sessionItem['user']['profile_picture']; ?>">
                        <div class="ml-3">
                            <h6 class="mb-0 font-weight-bold"><?= $sessionItem['user']['full_name']; ?></h6>
                            <small><?= $sessionItem['created_at']; ?></small>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="<?= session('user_role_id') == 2 ? 'mr-3' : ''; ?>">
                            <?php if ($sessionItem['type'] == 2 && session('user_role_id') == 2) : ?>
                                <a href="/penilaian/<?= $sessionItem['id']; ?>" class="no-style-link">
                                    <span class="badge badge-pill badge-primary"><?= $sessionItem['code']; ?></span>
                                </a>
                            <?php endif; ?>
                            <span class="badge badge-pill ml-1 <?= $sessionItem['type'] == 1 ? 'badge-info' : 'badge-warning'; ?>"><?= $sessionItem['type'] == 1 ? 'Diskusi' : 'Tugas'; ?></span>
                        </div>
                        <div class="dropdown text-center <?= session('user_role_id') == 2 ? '' : 'd-none'; ?>" style="width: 20px;">
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
                </div>

                <p class="mt-4" style="font-size: 16px;"><?= $sessionItem['text']; ?></p>

                <?php if ($sessionItem['file']) : ?>
                    <a href="/pertemuan/item/download/<?= $sessionItem['id']; ?>" class="no-style-link">
                        <div class="d-flex align-items-center <?= $sessionItem['type'] == 1 ? 'bg-info' : 'bg-warning'; ?> text-white p-3 rounded">
                            <i class="fas fa-file-alt mr-2" style="font-size: 32px"></i>
                            <h6 class="mb-0"><?= $sessionItem['file']; ?></h6>
                        </div>
                    </a>
                <?php endif; ?>

                <?php
                $filteredAssignments = array_filter($sessionItem['student_assignments'], fn ($item) => $item['session_item_id'] == $sessionItem['id'] && $item['student']['user']['id'] == session('user_id'));

                $filteredAssignments = array_values($filteredAssignments)
                ?>

                <?php if ($sessionItem['type'] == 2 && session('user_role_id') == 3) : ?>
                    <form action="/pertemuan/tugas" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="session_item_id" value="<?= $sessionItem['id']; ?>">
                        <input type="hidden" name="session_id" value="<?= $sessionItem['session_id']; ?>">

                        <?php if (count($filteredAssignments) > 0) : ?>
                            <div class="row mt-3">
                                <div class="col-md-9 d-flex align-items-center">
                                    <div class="border-gray-300 rounded bg-gray-300 mb-0 py-3 w-100" style="cursor: pointer;">
                                        <h5 id="assignment-file-preview" class="text-center mb-0">Tugas Sudah Dikumpulkan...</h5>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <button class="btn btn-block btn-secondary h-100" type="button" data-toggle="modal" data-target="#detailAssignmentModal<?= $sessionItem['id']; ?>">Detail</button>

                                    <!-- Modal Detail Tugas -->
                                    <div class="modal fade" id="detailAssignmentModal<?= $sessionItem['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailAssignmentModal<?= $sessionItem['id']; ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailAssignmentModal<?= $sessionItem['id']; ?>Label">
                                                        Detail Tugas
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="font-size: 20px;">
                                                    <div class="row">
                                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                                            <div>File</div>
                                                            <div>:</div>
                                                        </div>
                                                        <div class="col-md-8 pl-0 one-line-text">
                                                            <?= $filteredAssignments[0]['file']; ?>
                                                        </div>
                                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                                            <div>Nilai</div>
                                                            <div>:</div>
                                                        </div>
                                                        <div class="col-md-8 pl-0 font-weight-bold">
                                                            <?= $filteredAssignments[0]['grade']; ?>
                                                        </div>
                                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                                            <div>Feedback</div>
                                                            <div>:</div>
                                                        </div>
                                                        <div class="col-md-8 pl-0">
                                                            <?php if ($filteredAssignments[0]['feedback']) : ?>
                                                                <?= $filteredAssignments[0]['feedback']; ?>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row mt-4">
                                <div class="col-md-9 d-flex align-items-center">
                                    <input type="file" class="d-none" id="assignment_file<?= $sessionItem['id']; ?>" name="assignment_file" onchange="previewAssignmentFile(<?= $sessionItem['id']; ?>)">
                                    <label for="assignment_file<?= $sessionItem['id']; ?>" class="dotted-border rounded bg-light mb-0 py-3 w-100" style="cursor: pointer;">
                                        <h5 id="assignment-file-preview" class="text-center mb-0">Kumpulkan Tugas...</h5>
                                    </label>
                                </div>
                                <div class="col-md-3 d-flex align-items-center">
                                    <button class="btn btn-block btn-primary h-100" type="submit">Kumpulkan</button>
                                </div>
                            </div>
                        <?php endif ?>
                    </form>
                <?php endif ?>
            </div>

            <div class="card-footer bg-white">
                <?php if ($sessionItem['session_item_comments']) : ?>
                    <?php foreach ($sessionItem['session_item_comments'] as $sessionItemComment) :  ?>
                        <div class="d-flex align-items-start mb-3">
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