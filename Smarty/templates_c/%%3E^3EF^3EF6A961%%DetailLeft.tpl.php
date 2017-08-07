<?php /* Smarty version 2.6.18, created on 2017-08-06 23:43:25
         compiled from Accounts/DetailLeft.tpl */ ?>
<div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse"  href="#collapseOne">
                  <i class="cus-table"></i>&nbsp;<b>相关操作</b>
                </a>
              </div>
              <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                   <ul class="nav nav-list">
                      <li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=DetailView&record=<?php echo $this->_tpl_vars['ID']; ?>
&parenttab=Customer" >客户详细页</a>
                      </li>
                      <li <?php if ($this->_tpl_vars['type'] == 'Notes'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Notes&parenttab=Customer" >联系记录</a>
                      </li>
                      <li <?php if ($this->_tpl_vars['type'] == 'Contacts'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Contacts&parenttab=Customer" >其他联系人</a>
                      </li>
                      <li <?php if ($this->_tpl_vars['type'] == 'Maillists'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Maillists&parenttab=Customer" >群发邮件记录</a>
                      </li>
                      <li <?php if ($this->_tpl_vars['type'] == 'Qunfas'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Qunfas&parenttab=Customer" >群发短信记录</a>
                      </li>
                      <li <?php if ($this->_tpl_vars['type'] == 'Memdays'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Memdays&parenttab=Customer" >纪念日</a>
                      </li>
                    
                      <li <?php if ($this->_tpl_vars['type'] == 'Products'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Products&parenttab=Customer" >已购买产品</a>
                      </li>   
					    <li <?php if ($this->_tpl_vars['type'] == 'Sales Order'): ?>class="active"<?php endif; ?>>
                        <a href="index.php?module=Accounts&action=RelateLists&record=<?php echo $this->_tpl_vars['ID']; ?>
&moduletype=Sales Order&parenttab=Customer" >订单明细</a>
                      </li>
                    </ul>
                </div>
              </div>
            </div>