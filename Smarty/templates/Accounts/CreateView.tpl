<script type="text/javascript" src="modules/{$MODULE}/{$SINGLE_MOD}.js"></script>

{*<!-- Contents -->*}
<form name="EditView" method="POST" action="index.php">
<input type="hidden" name="module" value="{$MODULE}">
<input type="hidden" name="record" value="{$ID}">
<input type="hidden" name="mode" value="{$MODE}">
<input type="hidden" name="action">
<input type="hidden" name="parenttab" value="{$CATEGORY}">
<input type="hidden" name="return_module" value="{$RETURN_MODULE}">
<input type="hidden" name="return_id" value="{$RETURN_ID}">
<input type="hidden" name="return_action" value="{$RETURN_ACTION}">
<input type="hidden" name="return_viewname" value="{$RETURN_VIEWNAME}">

<!-- center start -->
     <div class="container-fluid">
        <div class="row-fluid">
          <div class="span2">
              <div class="accordion" id="accordion2" style="margin-top:0px;margin-bottom:0px;">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse"  href="#collapseOne">
                      <i class="cus-table"></i>&nbsp;<b>相关操作</b>
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <ul class="nav nav-list">
	                        
                        </ul>
                    </div>
                  </div>
                </div>

             </div>
          </div>
          <div class="span10" style="margin-left:10px;">
             <div  class="pull-left" style="margin-bottom:5px;" >
                  <button class="btn btn-small btn-primary" style="margin-top:2px;" onclick="goback();">
                    <i class="icon-arrow-left icon-white"></i>取消</button>
              </div>
              <div class="pull-right" style="margin-bottom:5px;" >
                  <button class="btn btn-small btn-success" style="margin-top:2px;" onclick="check_duplicate(this,'Save')" name="savebutton" type="button">
                    <i class="icon-ok icon-white"></i> 保存 </button>
                 
             </div>
             <div class="clearfix"></div>
              <div class="accordion"  style="margin-top:0px;margin-bottom:0px;">
              	{foreach key=header item=data name=listviewforeach from=$BASBLOCKS}
                  <div class="accordion-group">
                     <div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse"  href="#detail_{$smarty.foreach.listviewforeach.iteration}">
                        {$header}
                      </a>
                    </div>
                    <div id="detail_{$smarty.foreach.listviewforeach.iteration}" class="accordion-body collapse in">
                      <div class="accordion-inner">
                          <table class="table table-bordered table-hover table-condensedforev dvtable">
                           <tbody>
                            {include file="DisplayFields.tpl"}
                           </tbody>
                          </table>
                     </div>
                   </div>
                  </div>
                  {/foreach}
                  
              </div>
               <div  class="pull-left" style="margin-bottom:5px;" >
                  <button class="btn btn-small btn-primary" style="margin-top:2px;" onclick="goback();">
                    <i class="icon-arrow-left icon-white"></i>取消</button>
              </div>
              <div class="pull-right" style="margin-bottom:5px;" >
                  <button class="btn btn-small btn-success" style="margin-top:2px;" onclick="check_duplicate(this,'Save')" name="savebutton">
                    <i class="icon-ok icon-white"></i> 保存 </button>
             </div>
             <div class="clearfix"></div>
            
          </div>
        </div>
     </div>
     <!-- center end -->
</form>

<script>	
        var fieldname = new Array({$VALIDATION_DATA_FIELDNAME})
        var fieldlabel = new Array({$VALIDATION_DATA_FIELDLABEL})
        var fielddatatype = new Array({$VALIDATION_DATA_FIELDDATATYPE})
		if(getObj("customernum") != undefined && getObj("customernum").value == "") {ldelim}
	        getObj("customernum").value = "{$APP.AUTO_GEN_CODE}";
		//getObj("customernum").setAttribute("readOnly","true");
	{rdelim}

</script>
 