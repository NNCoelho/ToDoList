<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col">
            <h3 class="p-3">ToDo List</h3>
        </div>
        <div class="col text-right align-self-center">
            <a href="<?= site_url('main/new_job') ?>" class="btn btn-primary">
                Criar Nova Tarefa...
            </a>
        </div>
    </div>
</header>

<hr>

<?php if(count($jobs) == 0): ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="alert alert-warning text-center">Não existem tarefas a realizar.</h3>
            </div>
        </div>
    </div>

<?php else: ?>

    <table class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th><i class="fa fa-suitcase"></i> Tarefa</th>
                <th class="text-center"><i class="far fa-calendar-check"></i> Data de criação</th>
                <th class="text-center"><i class="fa fa-trophy"></i> Data de finalização</th>
                <th class="text-center"><i class="fa fa-cog"></i> Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($jobs as $job): ?>
                <tr>
                    <td><?= $job->job ?></td>
                    <td class="text-center"><?= $job->datetime_created ?></td>
                    <td class="text-center"><?= $job->datetime_finished ?></td>
                    <td class="text-center">

                        <!-- Tarefa realizada -->
                        <?php if(empty($job->datetime_finished)): ?>
                            <a href="<?= site_url('main/jobdone/'.$job->id_job) ?>" class="btn btn-success btn-sm mr-1"><i class="fa fa-check"></i></a>
                        <?php else: ?>
                            <button class="mr-1 btn btn-warning btn-sm" disabled><i class="fa fa-trophy"></i></button>
                        <?php endif; ?>

                        <!-- Editar tarefa -->
                        <?php if(empty($job->datetime_finished)): ?>
                            <a href="<?= site_url('main/editjob/'.$job->id_job) ?>" class="btn btn-primary btn-sm mr-1"><i class="fas fa-pencil-alt"></i></a>
                        <?php else: ?>
                            <button class="mr-1 btn btn-dark btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>
                        <?php endif; ?>

                        <!-- Eliminar tarefa -->
                        <a href="<?= site_url('main/deletejob/'.$job->id_job) ?>" class="btn btn-danger btn-sm mr-1"><i class="fa fa-trash"></i></a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Nº total de tarefas: <strong><?= count($jobs) ?></strong></p>

<?php endif; ?>

<?= $this->endSection() ?>