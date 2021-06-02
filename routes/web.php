<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//when first our application is opened this is the route which will be taken, which redirects the user to the
// login form
Route::get("/", [\App\Http\Controllers\Auth\LoginController::class,"showLoginForm"])->name('home');
//artistsRoute


//this route will ge the user to the sinUp form
Route::post("/signUp",[\App\Http\Controllers\Auth\SignUpController::class,"registerUser"]) ->name("register");
//this route will be taken when the user wants to register in the system
Route::get("/signUp", [\App\Http\Controllers\Auth\SignUpController::class,"signUpForm"]) -> name("signUpForm");

Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class,"showLoginForm"]) ->name("loginForm");
Route::post("/login", [\App\Http\Controllers\Auth\LoginController::class,"logIn"]) ->name("login");

//route that will be called when the user logs out
Route::post("/logout",[\App\Http\Controllers\Auth\LogOutController::class,"logOut"])->name("logout");

//manage users route
Route::get("/manageUsers",[\App\Http\Controllers\admin\manageUsers\ManageUsersController::class, "showUsers"])->name("manageUsers");
//add user route
Route::get("/addUser", [\App\Http\Controllers\admin\manageUsers\AddUserController::class, "addUserForm"])->name("addUserForm");
Route::post("/addUser", [\App\Http\Controllers\admin\manageUsers\AddUserController::class, "registerUser"])->name("registerUser");
//update users route
Route::get("/updateUser/{user}",[\App\Http\Controllers\admin\manageUsers\UpdateUserController::class, "updateForm"])->name("updateUserForm");
Route::put("/confirmUpdateUser/{user}",[\App\Http\Controllers\admin\manageUsers\UpdateUserController::class, "updateUser"])->name("updateUser");
//route to delete the users
Route::delete("/deleteUser/{user}",[\App\Http\Controllers\admin\manageUsers\DeleteUserController::class, "deleteUser"])->name("deleteUser");


//manageStudios route
Route::get("/manageStudios", [\App\Http\Controllers\admin\manageStudios\ManageStudiosController::class, "showStudios"])->name("showStudios");
//route that will take you to the add Studio form
Route::get("/addStudio", [\App\Http\Controllers\admin\manageStudios\AddStudioController::class, "showAddStudioForm"])->name("addStudioForm");
//route to submit the added studio
Route::post("/addStudio", [\App\Http\Controllers\admin\manageStudios\AddStudioController::class, "registerStudio"])->name("registerStudio");
//updateStudio routes
Route::get("/updateStudio/{studio}", [\App\Http\Controllers\admin\manageStudios\UpdateStudioController::class, "showUpdateStudioForm"])->name("updateStudioForm");
Route::put("/confirmUpdateStudio/{studio}", [\App\Http\Controllers\admin\manageStudios\UpdateStudioController::class, "updateStudio"])->name("updateStudio");
//deleteStudio route
Route::delete("/deleteStudio/{studio}", [\App\Http\Controllers\admin\manageStudios\DeleteStudioController::class, "deleteStudio"])->name("deleteStudio");

//artists albums route
Route::get("/artistAlbums", [\App\Http\Controllers\artist\manageAlbums\ArtistAlbumsController::class, "showArtistAlbums"])->name("artistAlbums");

//add album route
Route::get("/addAlbum", [\App\Http\Controllers\artist\manageAlbums\AddAlbumController::class, "showAddAlbumForm"])->name("addAlbumForm");
Route::post("/addAlbum", [\App\Http\Controllers\artist\manageAlbums\AddAlbumController::class, "addAlbum"])->name("addAlbum");

//updateAlbumRoute
Route::get("/updateAlbum/{album}", [\App\Http\Controllers\artist\manageAlbums\UpdateAlbumController::class, "showUpdateForm"])->name("updateAlbumForm");
Route::put("/updateAlbum/{album}", [\App\Http\Controllers\artist\manageAlbums\UpdateAlbumController::class, "updateAlbum"])->name("updateAlbum");

//deleteAlbum route
Route::delete("/deleteAlbum/{album}", [\App\Http\Controllers\artist\manageAlbums\DeleteAlbumController::class, "deleteAlbum"])->name("deleteAlbum");


//artist songs route
Route::get("/artistSongs", [\App\Http\Controllers\artist\manageSongs\ArtistSongsController::class, "showArtistSongs"])->name("artistSongs");

//addSong route
Route::get("/addSong", [\App\Http\Controllers\artist\manageSongs\AddSongController::class, "showAddSongForm"])->name("addSongForm");
Route::post("/addSong", [\App\Http\Controllers\artist\manageSongs\AddSongController::class, "addSong"])->name("addSong");

//update Song route
Route::get("/updateSong/{song}", [\App\Http\Controllers\artist\manageSongs\UpdateSongController::class, "showUpdateForm"])->name("updateSongForm");
Route::put("/updateSong/{song}", [\App\Http\Controllers\artist\manageSongs\UpdateSongController::class, "updateSong"])->name("updateSong");

//deleteSong soute
Route::delete("/deleteSong/{song}", [\App\Http\Controllers\artist\manageSongs\DeleteSongController::class, "deleteSong"])->name("deleteSong");

//artists Page route
Route::get("/artists", [\App\Http\Controllers\artistsPages\ArtistsController::class,"artistsPage"])->name('artists');
//artist info route
Route::get("artistInfo/{artist}", [\App\Http\Controllers\artistsPages\ArtistInfoController::class, "showArtistInfo"])->name("artistInfo");

//studios Page route
Route::get("/studios", [\App\Http\Controllers\studiosPages\StudiosController::class,"studiosPage"])->name('studios');
//studio Info route
Route::get("/studioInfo/{studio}", [\App\Http\Controllers\studiosPages\StudioInfoController::class,"showStudioInfo"])->name('studioInfo');

//albums route
Route::get("/albums", [\App\Http\Controllers\albumsPages\AlbumsController::class,"showAlbums"])->name('albums');
//albumInfo route
Route::get("/albumInfo/{album}", [\App\Http\Controllers\albumsPages\AlbumInfoController::class,"showAlbumInfo"])->name('albumInfo');

//submit comment and rate route
Route::post("/addCommentRate/{album}", [\App\Http\Controllers\albumsPages\CommentRatesController::class, "addCommentandRate"])->name("addCommentandRate");

//deleteComment route
Route::delete("/deleteCommentRate/{comment}", [\App\Http\Controllers\albumsPages\CommentRatesController::class, "deleteComment"])->name("deleteComment");



