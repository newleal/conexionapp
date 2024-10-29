<?php require (APPROOT . '/views/shared/header.php') ?>
<a href="<?php echo URLROOT . '/posts/index'; ?>" role="button" class="btn btn-warning pull-right">
    <i class="fas fa-arrow-left"></i> Regresar
</a>
<div class="card card-body bg-light mt-5">
    <h2>
        Crear Publicación
    </h2>
    <p>Por favor ingfrese los datos de su publicacion</p>
    
    
    <form action="<?php echo URLROOT . '/posts/add';?>" method="post">
        <div class="form-group">
            <label for="title">Titulo:<sup>*</sup></label>
            <input type="text" name="title" id="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>"  placeholder="titulo" >
            <span class="'invalid-feedback'"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="body">Contenido:<sup>*</sup></label>
            <textarea name="body" id="body" class="form-control <?php echo (!empty($data['body_err']))? 'is-invalid': ''; ?>" rows="5" ><?php echo $data['body']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        
        <div class="row">
            <div class="col">
                <input type="submit" value="Crear publicacion" class="btn btn-primary btn-block mt-3">
            </div>
        </div>
    </form>
</div>
<?php require (APPROOT . '/views/shared/footer.php') ?>