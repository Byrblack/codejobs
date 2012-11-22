<?php
    if(!defined("_access")) {
        die("Error: You don't have permission to access here...");
    }
    
    $this->CSS("code", "codes", TRUE);

    $URL = path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]);
?>
<div class="codes">
	<h2>
		<?php echo getLanguage($code["Language"], TRUE); ?> <a href="<?php echo $URL; ?>" title="<?php echo quotes($code["Title"]); ?>"><?php echo quotes($code["Title"]); ?></a>
	</h2>

	<span class="small italic grey">
		<?php 
			echo __("Published") ." ". howLong($code["Start_Date"]) ." ". __("by") .' <a title="'. $code["Author"] .'" href="'. path("codes/author/". $code["Author"]) .'">'. $code["Author"] .'</a> '; 
			 
			if($code["Languages"] !== "") {
				echo __("in") ." ". exploding(implode(", ", array_map("strtolower", explode(", ", $code["Languages"]))), "codes/language/");
			}
		?>			
		<br />

		<?php 
			echo '<span class="bold">'. __("Likes") .":</span> ". (int) $code["Likes"]; 
			echo ' <span class="bold">'. __("Dislikes") .":</span> ". (int) $code["Dislikes"];
			echo ' <span class="bold">'. __("Views") .":</span> ". (int) $code["Views"];
		?>
	</span>

    <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_tweet" tw:via="codejobs" addthis:title="#Code <?php echo $code["Title"]; ?>" tw:url="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]); ?>"></a>
    </div>

    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-5026e83358e73317"></script> 

    <?php
        if($code["Description"] !== "") {
            echo str_replace("\\", "", htmlTag("p", showLinks($code["Description"])));
        }

        foreach ($code["Files"] as $file) {
        ?>
            <p>
                <div class="title-file">
                    <?php
                        echo htmlTag("div", array("class" => "filename"), $file["Name"]);
                        
                        echo htmlTag("a", array(
                            "name"  => slug($file["Name"]),
                            "class" => "permalink",
                            "title" => __("Permalink to this file"),
                            "href"  => "#" . slug($file["Name"])
                        ), "&para;&nbsp;");
                    ?>
                </div>

                <textarea name="code" data-syntax="<?php echo $file["ID_Syntax"];?>"><?php echo stripslashes($file["Code"]); ?></textarea>
            </p>
        <?php
        }
		
        if(SESSION("ZanUser")) {
	    ?>
			<p class="small italic">
				<?php  echo like($code["ID_Code"], "codes", $code["Likes"]) ." ". dislike($code["ID_Code"], "codes", $code["Dislikes"]) ." ". report($code["ID_Code"], "codes"); ?>
			</p>

            <p>
                <a href="<?php echo path("codes/download/" . $code['ID_Code'] . "/" . $code['Slug']); ?>" class="btn download"><?php echo __("Download code"); ?></a>
            </p>
	    <?php
		}
	?>

    <a href="https://twitter.com/codejobs" class="twitter-follow-button" data-show-count="false" data-lang="es" data-size="large"><?php echo __("Follow"); ?> @codejobs</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <br />
    
    <?php
        echo display('<p>
                        <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-4006994369722584";
                            /* CodeJobs.biz */
                            google_ad_slot = "1672839256";
                            google_ad_width = 728;
                            google_ad_height = 90;
                            //-->
                            </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                        </script>
                    </p>', 4);
    ?>   

    <p>
        <a name="comments">
            <div class="fb-comments" data-href="<?php echo path("codes/". $code["ID_Code"] ."/". $code["Slug"], FALSE, $code["Language"]); ?>" data-num-posts="2" data-width="750"></div>
        </a>
    </p>
	
	<p>
		<a href="<?php echo path("codes"); ?>">&lt;&lt; <?php echo __("Go back"); ?></a>
	</p>
</div>

<script type="text/javascript">
    var syntax = [];
    
    <?php
        $data = getSyntax();
        
        foreach($data as $language) {
        ?>
            syntax[<?php echo $language["ID_Syntax"]; ?>] = <?php echo json($language); ?>;
        <?php
        }
    ?>
</script>

<?php
    echo $this->js("codes.js", "codes", TRUE);
?>