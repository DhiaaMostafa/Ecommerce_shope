<script>
function checkform() {
    if(document.frmMr.start_date.value == "") {
        alert("please enter start_date");
        return false;
    } else {
        document.frmMr.submit();
    }
}
</script>
// HTML
<html>
    <form name=frmMr action="page1.jsp">
        Enter Start date:
        <input type="text" size="15" name="start_date" id="start_date">
        <input type="submit" name="continue" value="submit" onClick="return checkform();">
    </form>
</html>