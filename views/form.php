
<form class="form-horizontal" method="POST" action="data/save">
<fieldset>
<input id="host-id" name="id" type="hidden" value="<?php echo $host['id']; ?>">

<div class="form-group">
  <label class="col-md-4 control-label" for="hostname">Hostname</label>  
  <div class="col-md-6">
  <input id="hostname" name="hostname" type="text" placeholder="" value="<?php echo $host['hostname']; ?>" class="form-control input-md" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="domain">Domain</label>  
  <div class="col-md-6">
  <input id="domain" name="domain" type="text" placeholder="" value="<?php echo $host['domain']; ?>" class="form-control input-md" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="ipv4">IPv4</label>  
  <div class="col-md-6">
  <input id="ipv4" name="ipv4" type="text" placeholder="" value="<?php echo $host['ipv4']; ?>" class="form-control input-md" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="ptr">PTR</label>
  <div class="col-md-4">
    <select id="ptr" name="ptr" class="form-control">
      <option value="1" <?php echo $host['ptr'] == 1 ? 'selected' : ''; ?>>True</option>
      <option value="0" <?php echo $host['ptr'] == 0 ? 'selected' : ''; ?>>False</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="dhcp">DHCP</label>
  <div class="col-md-4">
    <select id="dhcp" name="dhcp" class="form-control">
      <option value="1" <?php echo $host['dhcp'] == 1 ? 'selected' : ''; ?>>True</option>
      <option value="0" <?php echo $host['dhcp'] == 0 ? 'selected' : ''; ?>>False</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="hwaddr">HW Address</label>  
  <div class="col-md-6">
  <input id="hwaddr" name="hwaddr" type="text" placeholder="" value="<?php echo $host['hwaddr']; ?>" class="form-control input-md">
  </div>
</div>

</fieldset>
</form>