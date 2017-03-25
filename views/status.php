		status 
1) hired
2) done screening
3) done orientation
4) lacking requirement
5) complete requirement
6) Not procced
7) Not Coming
8) Done Releasing Paycard
9) Deploy

ambrospac@gmail.com

purpose

1) screening
2) Orientation
3) Process Requirement
4) Releasing Pay Card
5) Deploy

condition purpose
if (screening){
	  done screening;
	  not coming

else if (orientation){
		done orientation;
		not coming
}
else if (Process requirement){
			complete requirement
			lacking requirement
			not Process
	
}
else if (Releasing Paycard){
			done Releasing Paycard
			not coming
}

condition status and purpose
if  (done screening and screening){
			disable status
}
else if (done orientation and orientation)
                disable button
else if (done releasing and releasing)
			disable status
else if (not coming and screening)


if (not coming && for screening){
       for screening
        not coming
}
else if (not coming  && for orientation)

	
	message notification

	userid 
	message
	from
	to
	unread

	messagebox
	where to and user id 



message
user 1  
user 2 

//for chat 
SELECT tblchat.message, tblclient.firstname, tblclient.lastname, tblclient.emailadd, tblclient.contact, tblbranch.branchname, tbllocation.locationname from tblchat 
INNER JOIN tblclient on tblchat.clientID=tblclient.clientID 
INNER JOIN tbllocation on tblclient.locationID=tbllocation.locationID
INNER JOIN tblbranch on tblclient.branchID=tblbranch.branchID WHERE tblchat.userID=1 ORDER BY tblchat.chatid DESC LIMIT 1

SELECT tblchat.message, tblclient.firstname, tblclient.lastname, tblclient.emailadd, tblclient.contact, tblbranch.branchname, tbllocation.locationname from tblchat INNER JOIN tblclient on tblchat.clientID=tblclient.clientID INNER JOIN tbllocation on tblclient.locationID=tbllocation.locationID INNER JOIN tblbranch on tblclient.branchID=tblbranch.branchID WHERE tblchat.userID=1 and tblchat.chatID = (SELECT MAX(chatID) as id from tblchat GROUP by clientID)

SELECT tblchat.message, tbluser.username, tblclient.username from tblchat INNER join tbluser on tblchat.userID = tbluser.userID INNER join tblclient on tblchat.clientID = tblclient.clientID WHERE tbluser.userID = 1 and tblclient.clientID =1

select tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact,tblapplicant.emailadd,tblapplicant.address,tblbranch.branchname,tbllocation.locationname from tblemployee 
INNER JOIN tblapplicant on tblemployee.applicantID = tblapplicant.applicantID
INNER JOIN tblclient on tblemployee.branchID = tblclient.branchID AND tblemployee.locationID =tblclient.locationID
INNER JOIN tblbranch on tblbranch.branchID= tblemployee.branchID
INNER JOIN tbllocation on tblemployee.locationID = tbllocation.locationID 


// 
select tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact,tblapplicant.emailadd,tblapplicant.address,tblbranch.branchname,tbllocation.locationname, tbluser.username from tblemployee 
INNER JOIN tblapplicant on tblemployee.applicantID = tblapplicant.applicantID
INNER JOIN tblclient on tblemployee.branchID = tblclient.branchID AND tblemployee.locationID =tblclient.locationID
INNER JOIN tblbranch on tblbranch.branchID= tblemployee.branchID
INNER JOIN tbllocation on tblemployee.locationID = tbllocation.locationID 
INNER JOIN tbluser on tblemployee.userID= tbluser.userID where tblclient.clientID =1	