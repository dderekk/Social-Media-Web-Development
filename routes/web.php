<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//setting the time zone to brsiabne
date_default_timezone_set('Australia/Brisbane');


// adding a post
// get all function of post
Route::Post('addPost', function () {
    $po_t = request('InpTitle');
    $po_n = request('InpAuthor');
    $po_m = request('InpMessage');

    $errorM = [];
    $errorM = inputVali($po_t,$po_n,$po_m,$errorM);

    // we check the data before go to the data set, and bring the data after
    $post = getAllPost();

    //check the error message, if yes print error, if no updating database
    if (!empty($errorM)) {
        return view('mainPage')->with('post',$post)->with('errorM',$errorM);
    } else {
        InsertPost($po_t,$po_n,$po_m);
        if((empty(session()->get('userName')))){
            session(['userName'=>"$po_n"]);
            $po_id = getUserID($po_n);
            session(['userID'=>"$po_id"]);
        }
        return redirect("/");
    }
});

// adding comment, get PostID and Comment ID(reply to)
Route::Post('addComment/{id}/{cid}', function ($id,$cid) {

    $po_u = request('InpUser');
    $po_c = request('InpComment');

    $errorM = [];
    $errorM = inputValiC($po_u,$po_c,$errorM);

    $detail = postdetail($id);              // get all details in post
    $authorname = getauthorname($id);       // get authorname base on the post id
    $commentsdetail = getcomdetail($id);    // get all comments detail with user name
    
    //check the error message, if yes print error, if no updating database
    
    InsertComment($po_u,$po_c,$id,$cid);
    if((empty(session()->get('userName')))){
        session(['userName'=>"$po_u"]);
        $po_id = getUserID($po_u);
        session(['userID'=>"$po_id"]);
    }
    return redirect("details/$id/0");

});

// adding a post
// get all function of post
Route::get('/', function () {
    $errorM = [];
    // we check the data before go to the data set, and bring the data after
    //Noce: LEFT JOIN will bring the data even there is no commonts
    $post = getAllPost();
    return view('mainPage')->with('post',$post)->with('errorM',$errorM);
});

//show all post
Route::get('allPost', function () {
    $post = getAllPost();
    return view('allPost')->with('post',$post);
});

// give author id, get all post regard with this aid
// get all function of post
Route::get('authorPosts/{aid}', function ($aid) {

    // we check the data before go to the data set, and bring the data after
    //Noce: LEFT JOIN will bring the data even there is no commonts
    $post = authorPosts($aid);
    return view('authorPosts')->with('post',$post);
});

// show all authors
Route::get('allauthors', function () {
    $author = authorPage();
    return view('authorPage')->with('author',$author);
});

// use for testing
Route::get('dbtest', function()
{
  $sql = "select * from users";
  $users = DB::select($sql);
	return view('dbtest')->with('users',$users);
});

// if session have name, use this to clean the name and id
Route::get('Logout', function()
{
  session()->forget('userName');
  session()->forget('userID');
  return redirect("/");
});

//delect post by post id
Route::post('DEL/{id}', function ($id){
    deletePost($id);
    return redirect("/");
});

// bring the id to database, gets all infor from this post id, and sent this to editpage,
Route::post('showPostEdit/{id}', function ($id)
{   
    $detail = postdetail($id);              // get all details in post
    $authorname = getauthorname($id);       // get authorname base on the post id
    $commentsdetail = getcomdetail($id);    // get all comments detail with user name

    $errorM = [];
    return view('editPage')->with('detail',$detail)->with('authorname',$authorname)->with('commentALL',$commentsdetail)->with('errorM',$errorM);
});

//from the form submit from postEdit, we change the data
Route::post('postEdit/{id}', function ($id)
{   
    $po_ct = request('changeTitle');
    $po_cp = request('changePost');
    $po_n = request('postName');
    //get the changed data, and put to check the validation
    $errorM = [];
    $errorM = inputVali($po_ct,$po_n,$po_cp,$errorM);

    //check the error message, if yes print error, if no updating database
    if (!empty($errorM)) {
        $detail = postdetail($id);              // get all details in post
        $authorname = getauthorname($id);       // get authorname base on the post id
        $commentsdetail = getcomdetail($id);    // get all comments detail with user name

        return view('editPage')->with('detail',$detail)->with('authorname',$authorname)->with('commentALL',$commentsdetail)->with('errorM',$errorM);
    } else {
        // if no error, we change title and message, give POSTid to tell which one is changing
        updatePost($id,$po_ct,$po_cp);
        return redirect("details/$id/0");
    }
});

//show details page
Route::get('details/{id}/{cid}', function ($id,$cid) {
    $detail = postdetail($id);              // get all details in post
    $authorname = getauthorname($id);       // get authorname base on the post id
    $commentsdetail = getcomdetail($id);    // get all comments detail with user name
    $numberLikes = getLikes($id);           // get number of likes

    if (!empty(session()->get('userID'))) {
        $currentUserID = session()->get('userID');
        $stateLikes = getLikeState($id,$currentUserID); //get current like state
    } else {
        $stateLikes = 2;
    }
    
    $errorM = [];
    return view('detailsPage')->with('detail',$detail)->with('authorname',$authorname)->with('commentALL',$commentsdetail)->with('errorM',$errorM)->with('likes',$numberLikes)->with('stateLike',$stateLikes)->with('replyCommentID',$cid);
});

//like functions
Route::post('likes/{pid}', function ($pid) {
    $currentUserID = session()->get('userID');
    
    if(empty($currentUserID)){
        $likeName = request('likeInpName');
        $currentUserID = getUserID($likeName);
    }
    
    $stateLikes = getLikeState($pid,$currentUserID);
    changeLikeState($pid,$currentUserID,$stateLikes);

    return redirect("details/$pid/0");
});

//###########################################################################################################################

//function get post ID as input, give all details post refer to this id
function postdetail($id){
    $sql = "select * from post where POSTid=?";
    $details = DB::select($sql,array($id));
    if (count($details) != 1){
        die("something has gone wrong, invalid query or result: $sql");
    }
    $detail = $details[0];
    return $detail;
}

// function get post ID as input, give auther/users name as output
function getauthorname($id){
    $sql = "select users.name from users,post where POSTid=? and users.usersid = post.authorid";
    $AuthorNames = DB::select($sql,array($id));
    if (count($AuthorNames) != 1){
        die("something has gone wrong, invalid query or result: $sql");
    }
    $AuthorName = $AuthorNames[0];
    return $AuthorName;
}

// function get post ID as input, give comment details as output
function getcomdetail($id){
    $sql = "select * from comments,users where users.usersID=comments.UsersID and comments.BelongPostID=?";
    $comentdetails = DB::select($sql,array($id));
    return $comentdetails;
}

// check the input validation for post
function inputVali($title,$name,$message,$errors){
    // Validate post title, no spcae
    $titleNoSpace = trim($title);
    $cleanedTitle = preg_replace('/\s+/', '', $titleNoSpace);
    if (strlen($cleanedTitle) < 3) {
        $errors[] = "Post title must have at least 3 characters.";
    }

    // Validate post author/users name
    if (preg_match('/\d/', $name)) {
        $errors[] = "Author name must not contain numeric characters.";
    }elseif(empty($name)){
        $errors[] = "Author name can not be blank.";
    }

    // Validate post message count
    if (str_word_count($message) < 5) {
        $errors[] = "Post message must have at least 5 words.";
    }
    return $errors;
}

// check the input validation for Comment
function inputValiC($name,$message,$errors){

    // Validate post user name
    if (preg_match('/\d/', $name)) {
        $errors[] = "User name must not contain numeric characters.";
    }elseif(empty($name)){
        $errors[] = "User name can not be blank.";
    }

    // Validate Comment count: no less than 2 words
    if (str_word_count($message) < 2) {
        $errors[] = "Message must have at least 2 words.";
    }
    return $errors;
}

// add the post input into database: 
//   1.  check name from user/author -> add new ID or not
//   2.  add post details into databse
function InsertPost($title,$name,$message){
    $sql = 'select usersID from users where Name = ?';
    $UserID = DB::select($sql,array($name));
    if (empty($UserID)){
        $sql2 = "INSERT INTO users (Name) VALUES (?)";
        DB::insert($sql2,array($name));
        $UserID = DB::select($sql,array($name));
    }
    $AuthorID = $UserID[0]->UsersID;

    /* may be delect
    $sql = "select authorID from author where Name = ?";
    $AuthorID = DB::select($sql,array($name));
    if (empty($AuthorID)){
        $sql2 = "INSERT INTO author (Name,UsersID) VALUES (?,?)";
        DB::insert($sql2,array($name, $UserID));
        $AuthorID = DB::select($sql,array($name));
        
    }
    $AuthorID = $AuthorID[0]->AuthorID;**/

    $sql = "INSERT INTO post (Title,Message,Post_Date,AuthorID) VALUES (?,?,?,?)";
    $currentDate = date('Y-m-d');
    DB::insert($sql,array($title,$message,$currentDate,$AuthorID));
}

// add the comment input into database: 
//   1.  check name from user -> add new ID or not
//   2.  add comment details into databse
function InsertComment($name,$message,$belongPost,$replyC){
    if($replyC==0){
        $replyC = NULL;
    }
    $sql = 'select usersID from users where Name = ?';
    $UserID = DB::select($sql,array($name));
    if (empty($UserID)){
        $sql2 = "INSERT INTO users (Name) VALUES (?)";
        DB::insert($sql2,array($name));
        $UserID = DB::select($sql,array($name));
    }
    $UserID = $UserID[0]->UsersID;

    $sql = "INSERT INTO comments (Message,Comment_Date,UsersID,BelongPostID,AppliedID) VALUES (?,?,?,?,?)";
    $currentDate = date('Y-m-d');
    DB::insert($sql,array($message,$currentDate,$UserID,$belongPost,$replyC));

}

//change the title and post message, date will update by $currentDate
function updatePost($pid,$title,$postmessage){
    $currentDate = date('Y-m-d');
    $sql = 'update post set Title=?,Message=?,Update_Date=? where POSTID=?';
    DB::update($sql,array($title,$postmessage,$currentDate,$pid));
}

// delete the post, base on the postid given
// delete the comment and likes first, and then delect the post
function deletePost($pid){
    $sql = 'delete from likes where POSTID=?';
    DB::delete($sql,array($pid));
    $sql = 'delete from comments where BelongPostID=?';
    DB::delete($sql,array($pid));
    $sql = 'delete from post where postid=?';
    DB::delete($sql,array($pid));
}

// function to return all post data from database, including number of comments
function getAllPost(){
    $sql = "select *,COUNT(comments.CommentID) as comNum from post,users LEFT JOIN comments ON post.POSTID = comments.BelongPostID where users.usersID = post.authorid Group By post.POSTID order by post.POSTID DESC" ;
    $post = DB::select($sql);
    return $post;
}

// function to return the number of likes base on the given post ID
function getLikes($pid){
    $sql = "select COUNT(*) as likes from likes where POSTid=? AND State=1";
    $likes = DB::select($sql,array($pid));
    return $likes[0];
}

//function to return the user id, by giving name as input
function getUserID($name){
    $sql = 'select usersID from users where Name = ?';
    $UserID1 = DB::select($sql,array($name));
    if(empty($UserID1)){
        $sql2 = "INSERT INTO users (Name) VALUES (?)";
        DB::insert($sql2,array($name));
        $UserID1 = DB::select($sql,array($name));
    }
    $UserID = $UserID1[0]->UsersID;
    return $UserID;
}

// chek the current like state, if no data in likes table, insert new data
function getLikeState($pid,$UserID){
    $sql = "select State from likes where POSTid=? AND UsersID=?";
    $likes = DB::select($sql,array($pid,$UserID));
    if (empty($likes)){
        $sql2 = "INSERT INTO likes (POSTid,UsersID,State) VALUES (?,?,0)";
        DB::insert($sql2,array($pid,$UserID));
        $likestate = 0;
    }else{
        $likestate = $likes[0]->State;
    }
    
    return $likestate;
}

// change the current like state, 1->0  0->1
function changeLikeState($pid,$UserID,$cstate){
    if ($cstate == 1){
        $sql = "update likes set State=0 where POSTid=? AND UsersID=?";
    }elseif($cstate == 0){
        $sql = "update likes set State=1 where POSTid=? AND UsersID=?";
    }
    DB::update($sql,array($pid,$UserID));
}

// give id and return all post of this author
function authorPosts($Aid){
    $sql = "SELECT *,COUNT(comments.CommentID) as comNum from post,users LEFT JOIN comments ON post.POSTID = comments.BelongPostID where users.usersid=post.authorid AND users.usersid = ? Group By post.POSTID order by post.POSTID DESC" ;
    $post = DB::select($sql,array($Aid));
    return $post;
}

// return the details of all poster,and how many posts they have
function authorPage(){
    $sql = "SELECT users.*, COUNT(post.AuthorID) AS NumPOST FROM users,post Where users.usersID = post.AuthorID GROUP BY users.usersID ORDER BY users.usersID";
    $author = DB::select($sql);
    return $author;
}