<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (empty($posts))
{
    if (empty($top) && empty($tail)) echo "<div class='alert'><h4>Alert!</h4> There are no page posts!</div>";
}
else
{

    if (empty($top) && empty($tail)) echo "<input type='hidden' id='top' name='top' value='" . $posts[0]->id . "'>";

    $lastid = null;
    foreach ($posts as $r)
    {
        $tc = $del = null;

        echo "<div id='post-wrap-{$r->id}'>";

        echo "<hr>";
        echo "<input type='hidden' name='id[]' value='{$r->id}'>\n";

        try
        {
            // $comments = $this->wall->getPostComments($r->id);
        }
        catch(Exception $e)
        {
            $this->functions->sendStackTrace($e);
        }

        /*
        if ($r->userid == $this->session->userdata('userid'))
        {
            $del = "  <a href=\"javascript:void(0);\" class='btn btn-link btn-mini' onclick=\"wall.deletePost(this, '{$r->id}')\"><i class='icon-trash'></i></a>";
        }
        */
        echo "<div class='row-fluid'>";

        echo "<div class='span1'><img src='/public/images/dude.gif'></div>";

        echo "<div class='span11'>";

        echo "<div class='row-fluid'><div class='span10'><strong>[username]</strong></div><div class='span2 pull-right' align='right'>{$del}</div></div>";

        echo "<div class='row-fluid'><blockquote>" . nl2br($r->post) . "</blockquote></div>";


        echo "<div class='row-fluid post-notes'>"; 

        if ($r->empLikes > 0) echo "<button type='button' class='btn btn-link' id='likeBtn-{$r->id}' onclick=\"wall.unlike(this, {$r->id});\"><i class='icon-thumbs-down'></i></button> ";
        else echo "<button type='button' class='btn btn-link' id='likeBtn-{$r->id}' onclick=\"post.like(this, {$r->id});\"><i class='icon-thumbs-up'></i></button> ";

        #echo "<a href='#' class='btn btn-link'><i class='icon-comment'></i></a> ";
        echo "<span class='gray'><span id='time_{$r->id}'>{$r->timeTxt}</span> &bull; [example.com]</span></div>";


        echo "<div id='likeContainer-{$r->id}'>";

        // displays likes
        if ($r->likes > 0)
        {
            echo "<div class='row-fluid post-actions likes'>";

            if ($r->likes == 1)
            {
                echo "<p><a href=\"javascript:void(0);\" onclick=\"wall.wholikes(" . $r->id . ");\">{$r->likes} Person</a> likes this</a></p>";
            }
            else
            {
                echo "<p><a href=\"javascript:void(0);\" onclick=\"wall.wholikes(" . $r->id . ");\">{$r->likes} People</a> like this</a></p>";
            }
            echo "</div>";
        }

        echo "</div>";

        // lists comments
        // echo $this->functions->renderWallComments($comments, $pagepermission[33]);

        echo "<div id='comment-display-{$r->id}'></div>\n"; // container for updating comments

// if ($res[4] == true) $taDis = "disabled='disabled'";

// comment box
echo <<< EOS
        
    <div class='row-fluid post-actions comment-box'>

            <textarea rows='1' onkeypress="posts.enterComment(this, event, '{$r->id}');" placeholder="Write a comment" {$taDis}></textarea>
    </div>
EOS;

        echo "</div>"; //.span11
        echo "</div>"; //.row-fluid
        echo "</div>"; // #post-wrap-%

    $lastid = $r->id;
    }


    if (empty($top) && empty($tail)) echo "<input type='hidden' id='tail' name='tail' value='{$lastid}'>";
}
?>
