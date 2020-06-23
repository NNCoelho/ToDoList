<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('conteudo') ?>

<header class="container">
    <div class="row">
        <div class="col align-self-center">
            <h3 class="p-3">ToDo List</h3>
        </div>
        <div class="col text-right align-self-center">
            <h3>Editar tarefa</h3>
        </div>
    </div>
</header>
<hr>

<?php 
    helper('form');
    echo form_open('main/editjobsubmition');
?>

    <input type="hidden" name="id_job" value="<?= $job->id_job ?>">

    <div class="container">
        <div class="row">
            <div class="col-4 offset-4">

                <div class="form-group">
                    <label>Designação da tarefa:</label>
                    <input type="text" name="job_name" class="form-control" value="<?= $job->job ?>" required>
                </div>

                <div class="row">
                    <div class="col">
                        <a href="<?= site_url('main') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                    <div class="col text-right">
                        <input type="submit" value="Atualizar" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </div>

<?= form_close() ?>

<?= $this->endSection() ?>