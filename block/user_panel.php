<? $userAccount = getUser();
$oneAccount = $userAccount->fetch_assoc();
?>
<table align="right" id="userTable">
    <tr>
        <td colspan="2">
            <p>Пользователь:</p>
        </td>
    </tr>
    <tr>
        <td id="userAvatar"><a href="account_settings.php" ><img src="<? echo $oneAccount['user_photo']; ?>" class = "Avatar" width="50" height="50"></a></td>
        <td id="userLogin" ><b><? echo $_SESSION['user_login']; ?></b></td>
        <td><a href="block/logout.php">Выход</a></td>
    </tr>
</table>


