<?php 
defined('_JEXEC') or die('Restricted access');

$cfg	 = & JEVConfig::getInstance();

if ($cfg->get("tooltiptype",'overlib')=='overlib'){
	JEVHelper::loadOverlib();
}

$view =  $this->getViewName();
echo $this->loadTemplate('cell' );
$eventCellClass = "EventCalendarCell_".$view;

// previous and following month names and links
$followingMonth = $this->datamodel->getFollowingMonth($this->data);
$precedingMonth = $this->datamodel->getPrecedingMonth($this->data);

?>

<div class="cal_events cal_span7">
    <div class="cal_header cal_span7">
    	<!-- <td width="2%" rowspan="2" /> -->
        <div class="cal_td_month cal_span2" style="text-align:center;">                
           <?php echo "<a href='".$precedingMonth["link"]."' title='".$precedingMonth['name']."' style='text-decoration:none;'>".$precedingMonth['name']."</a>";?>
        </div>
        <div class="cal_td_currentmonth cal_span3" style="text-align:center;"><?php echo $this->data['fieldsetText']; ?></div>
        <div class="cal_td_month cal_span2" style="text-align:center;">                
           <?php echo "<a href='".$followingMonth["link"]."' title='".$followingMonth['name']."' style='text-decoration:none;'>".$followingMonth['name']."</a>";?>
        </div>
    </div>
    <div class="cal_span7 cal_daysofweek">
         <?php foreach ($this->data["daynames"] as $dayname) { ?>
            <div class="cal_span1" width="14%" align="center" style="height:25px!important;line-height:25px;font-weight:bold;">
                <?php 
                echo $dayname;?>
            </div>
            <?php
        } ?>
    </div>            
    <?php
    $datacount = count($this->data["dates"]);
    $dn=0;
    for ($w=0;$w<6 && $dn<$datacount;$w++){
    ?>           
	<div class="cal_span7 cal_week">
        <?php
        // echo "<td width='2%' class='cal_td_weeklink'>";
        // list($week,$link) = each($this->data['weeks']);
        // echo "<a href='".$link."'>$week</a></td>\n";

        for ($d=0;$d<7 && $dn<$datacount;$d++){
        	$currentDay = $this->data["dates"][$dn];
        	switch ($currentDay["monthType"]){
        		case "prior":
        		case "following":
        		?>
            <div width="14%" class="cal_td_daysoutofmonth cal_span1 cal_day" valign="middle">
                <?php echo JEVHelper::getMonthName($currentDay["month"]); ?>
            </div>
            	<?php
            	break;
        		case "current":
        			$cellclass = $currentDay["today"]?'class="cal_td_today cal_span1 cal_day"':'class="cal_td_daysnoevents cal_span1 cal_day"';
        			// stating the height here is needed for konqueror and safari
				?>
            <div <?php echo $cellclass;?> width="14%" valign="top">
                <?php $this->_datecellAddEvent($this->year, $this->month, $currentDay["d"]);?>
            	<!-- <a class="cal_daylink" href="<?php echo $currentDay["link"]; ?>" title="<?php echo JText::_('JEV_CLICK_TOSWITCH_DAY'); ?>"><?php echo $currentDay['d']; ?></a> -->
            	<span class="cal_daylink"><?php echo $currentDay['d']; ?></span>
                <?php
                
                if (count($currentDay["events"])>0){
                	foreach ($currentDay["events"] as $key=>$val){
						if( $currentDay['countDisplay'] < $cfg->get('com_calMaxDisplay',5)) {
                			echo '<div style="border:0;padding:0px">' . "\n";
						} else {
							echo '<div style="float:left; border:0;padding:0px;">' . "\n";
						}
                		$ecc = new $eventCellClass($val, $this->datamodel,$this);
                		echo $ecc->calendarCell($currentDay,$this->year,$this->month,$key);
                		echo '</div>' . "\n";
						$currentDay['countDisplay']++;
                	}
                }
                echo "</div>\n";
                break;
        	}
        	$dn++;
        }
        echo "</div>\n";
    }
    echo "</div>\n";
     $this->eventsLegend();
