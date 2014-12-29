#Project Overview

The course project this semester is Prinstagram, a system for sharing photos. (The Pr(i) in stands for Privacy.) Prinstagram gives users somewhat more privacy than many photo sharing sites by giving them more detailed control over who can see which photos they post and more control over whether other people can tag photos their personal information.
Users will be able to log in, post photos, view some of the photos posted by their friends, tag photos with usernames of people in the photos, etc. In part 1 of the project, you will design an ER diagram for the database. In part 2, you will convert my E-R diagram (which I will post later) to a relational schema, write table definitions in SQL, and write some queries. Part 3 will be the most work: using my schema from part 2, you will revise your queries, if necessary, and write application code for the system. A detailed specification will be provided shortly after part 2 is due. (The emphasis will be on information about the photos, rather than the photos themselves, so displaying actual photos will be optional in part 3.)

##PART 1

Prinstagram allows users to define groups of friends (called FriendGroups), and to share photos with specific FriendGroups. For example, suppose Ann has a "family" FriendGroup and a "besties" friend group. She might share photos of her cat with "family" and photos of a wild party with "besties".
Draw an ER diagram modeling the data needed for the system. It should include entity sets (possibly including one or more weak entity sets) representing Person, Photo, and FriendGroup and several relationship sets.
Each Person has a unique username, a password, and a name, consisting of a first name and a last name.
Each Photo has a unique ID, a caption, a date (when it was taken), a location, consisting of latitude, longitude, and location name, and an indication of whether it is public, as well as the image. Each photo is posted by exactly one person.

A FriendGroup has a name and a description. Different people may have FriendGroups with the same name (and description), but an individual user cannot have more than one FriendGroup with the same name. For example, Ann and Bob can both have FriendGroups named "family" and they can even have the same description, but Ann cannot have two friend groups named "family".

Each FriendGroup is owned by exacly one person (the person who is defining a group of his/her friends). Each FriendGroup has (zero or more) members in the group. For example Ann can create a FriendGroup called "family" with members Cathy, David, and Ellen. A photo can be shared with a FriendGroup. For example, Ann can post a photo of her cat and share it with her family FriendGroup, which allows them to see the photo.
A person can comment on a photo. A comment includes a timestamp and the text of the comment. A person can make multiple comments about the same photo.

A person can tag a photo with someone’s username. For example, if David is in Ann’s cat photo, Ann or David or someone else can tag it with David’s username. We want to keep track of who added the
tag (the tagger) as well as who is tagged (in this case, David), and when the tag was added. In addition Prinstagram will only display tags that have been approved by the person who is tagged (e.g. David), so we need to keep track of the status of a tag.

**What You Should Do**

Design an ER diagram for Prinstagram. When you do this, think about: which information should be represented as attributes, which as entity sets or relationship sets? Are any of the entity sets weak entity sets? If so, what is the identifying strong entity set? What is the primary keys (or discriminant) of each entity set? What are the cardinality constraints on the relationship sets?

Draw the ER diagram neatly. You may draw it by hand or use a drawing tool.

Hand in a HARD COPY of your E-R diagram. MAKE SURE YOUR NAME AND YOUR PART-
NER’S NAME ARE ON IT.

##PART 2

A. Using the attached E-R diagram (my solution to Part 1), use the procedures we studied to derive a relational schema, then write SQL CREATE TABLE statements and execute them in your database system. Remember to include primary key and foreign key constraints. (You don’t have to hand in the schema diagram, only the create table statements, but you may find it useful to draw a schema diagram.) Use the following data types:
  * for attributes representing dates or times use the datetime or timestamp type.
  * for password use char(32). We will use this to store md-5 hashes of strings users choose as their passwords. If you prefer, you may use another crytographic hash, such as SHA, but you will need to tweak the test data we give you for the project demonstration.
  * The is pub attribute is Boolean (or integer).
  * The img attribute is a blob.
  * The ID attribute is an integer.
  * All other attributes are variable length character strings with some reasonable maximum length.

B. Write SQL INSERT statements corresponding to the following situation:
  * Each of the people mentioned below is in the Person table with the given first name, same last name, intitials as username, and md5 of their initials as password. For example, Ann is (’AA’, md5(’AA’),Ann,Ann).
  * Ann has a FriendGroup called "family" with members Ann, Cathy, David, and Ellen.
  * Bob has a FriendGroup called "family" with members Bob, Fred, and Ellen.
  * Ann has a FriendGroup called "besties" with members Ann, Gina, and Helen.
  * Ann posted a photo with ID=1, caption = "Whiskers", is pub = False, and shared it with her "family" FriendGroup.
  * Ann posted a photo with ID=2, caption = "My birthday party", is pub = False, and shared it with her "besties" FriendGroup.
  * Bob posted a photo with ID=3, caption = "Rover", is pub = False, and shared it with his "family" FriendGroup.
  * You can set the img attribute to NULL and make up data for the other attributes or make them NULL.

C. Write a query to show the ID and caption of each photo that is shared with David (i.e the photos David can view).

**What to hand in for Part 2:**
Use electronic handin to hand in a single file with the CREATE TABLE, INSERT, and SELECT statements in that order. We should be able to execute this file, so comment out anything that isn’t SQL. The comment delimiter is double hyphen. If you’re working with a partner, be sure to include both of your names as comments.

##PART 3

In part 3 of the project, you will use the table definitions I posted (solution to part 2) to implement application code for Prinstagram as a web-based application. You may use PHP, Java, or C#. If you’d like to use some other language, check with me by Nov 7. You must use prepared statements.

Your Prinstagram implementation should allow users to log in, post photos, view photos that are public or that are shared with FriendGroups to which they belong, and propose to tag photos with usernames of other users, provided the photos are visible to both the user (the tagger) and the person being tagged (the taggee), and manage tag proposals. Assume each user has already registered and created a password, which is stored as an md5 hash. If you’d like, you may display actual photos, but this is not required. When we test your application, we’ll check data about the photos (such as pid) rather than actual photos.

A photo is visible to a user U if either
* The photo is public, or
* The photo is shared with a FriendGroup to which U belongs , where the FriendGroup is owned by the poster of the photo.

(Remember that FriendGroups are identified by their gname along with the username of the owner of the group.) We will assume that in the initial database, if (x,y,z) is in SharedWith(ID,gname,ownername) then z is the poster of photo x. We will also assume that the owner of a FriendGroup is a member of that FriendGroup. (When modifying the database, Prinstagram should enforce these constraints.)

Specifically, Prinstagram ahould support the following use cases:

1. **Login:** The user enters username and password. Prinstagram checks whether the md5 hash of the password matches the stored password for that username. If so, it initiates a session, storing the username and any other relevant data in session variables, then goes to the home page (or provides some mechanism for the user to select their next action.) If the password does not match stored password for that username (or no such user exists) Prinstagram informs the user that the the login failed and does not initiate the session. The remaining features require the user to be logged in.
2. **View photos and info about them:** Prinstagram shows the user a list of pids,posters, pdates, and captions of photos that are visible to the her, arranged in reverse chronological order. (Op- tionally, include a link to an actual photo.) Along with each photo there is way for the user to see further information, including
  * first name and last name of people who have been tagged in the photo (tagees), provided that they have accepted the tags (Tag.status == true)
  * comments about the photo
3. **Manage tags:** Prinstagram shows the user relevant data about photos that have proposed tags of this user (i.e. user is the tagee and status false.) User can choose to accept a tag (change status to true), decline a tag (remove the tag from Tag table), or not make a decision (leave the proposed tag in the table with status == false.)
4. **Post a photo:** User enters the caption (and optionally, a link to a real photo)and a designation of whether the photo is public or private. Prinstagram inserts data about the photo (including current time, and current user as owner) into the Photo table. If the photo is private, Prinstagram gives the user a way to designate FriendGroups (that the user owns) with which the Photo is shared.
5. **Tag a photo:** Current user, who we’ll call x, selects a photo that is visible to her and proposes to tag it with username y
  * If the user is self-tagging (y == x), Prinstagram adds a tuple (x, x, true) to the tag table.
  * else if the photo is visible to y, Prinstagram adds a tuple (x, y, false) to the tag table.
  * else Prinstagram doesn’t change the tag table and prints some message saying that it cannot propose this tag. If you are working with a partner, also
6. **Add friend:** User selects an existing one of user’s FriendGroups and provides first name and lastname. Prinstagram checks whether there is exactly one person with that name and updates InGroup to indicate that the selected person is now in the FriendGroup. Unusual situation such as multiple people with the same name and the selected person already being in the FriendGroup should be handled gracefully.
7. **Your choice:** Add at least one more reasonably interesting feature. (Registration page is not interesting.) Write a brief explanation of the feature and implement it.
8. **Defriend:** Required for teams; extra credit for people working alone: Think about what should be done when someone is defriended, including some reasonable approach to tags that they posted or saw by virtue of being in the friend group. Write a short summary of how you’re handling this situation. Implement it and test it.

##Partners, etc

You may work alone or with a partner. You may work on part 1 alone then choose a partner for parts 2 and/or 3, but you may not switch partners. If you work with a partner, you will be required to add one or two extra features (which I will specify) to the application, but the total amount of work per person will be less than if you work alone. **If you are doing this project with a partner, you must notify me by sending e-mail to the grader by Nov 7.** His address is posted in the Syllabus section on Classes. Note that each partner is expected to contribute roughly equally and each partner is responsible for understanding the entire system. The quiz or exam question about the project will test each person individually.

The total project grade will be 25% of your course grade. Part 1 counts for about 15% of the project grade. Part 2 counts for about 20% of the project grade. There may also be a quiz or exam question(s) based on the project.

---

#Addendum

##What I forgot to include in the spec for part 3
* You should guard against SQL injection attacks, preferably by using prepared statements (if the language you’re using supports them).
* You should guard against users taking actions that they’re not allowed to do. For example, Prinstagram should not allow a user to post a comment about a photo that they’re not allowed to view.
* You should guard against cross-site scripting
* (If the fact that I’m mentioning these things at such a late date causes problems for you, please e-mail me.)

##You will hand in a zip containing
1. Your source code (zipped). If you’re using PHP should be able to plop this into the appropriate directory, unzip it, and execute your code. If you’re using a compiled language, you can also include bytecode, but don’t include large binary files.
2. A text or pdf file listing the main queries that are executed for each use case (preferably in prepared statements, along with a list of what the parameters represent ... for example: `SELECT * FROM t WHERE a = ? AND b= ?;` first param is current user’s id, second param is ... ). This should be neatly organized and documented so that we can quickly check
your queries. It should be in a file called "queries".
3. A list of the files in your application and what's in each file. (E.g. "homepage.php: script to generate home page".)
4. Brief description of any additional features you added.
5. List of any additions or modifications of the table definitions (such as adding constraints).
6. Brief explanation of your extra feature(s) and (for team projects) the "defriend" use case.
7. For team projects: A summary of who did what.

##Project Demos

Project demos will be after Thanksgiving. We will post some kind of sign up form. Both team members must be present. We will take some measures to insure that the code you’re executing in the demo is the code you handed in, so don’t change it after you hand it in. Each demo will take about 20 minutes to half an hour. You do not need to prepare a formal presentation. We will give you some data to load into the tables before your demo. During the demo, we will lead you through several tests ("log in as so and so", "post such and such", ...), and will ask you to explain some of your code. You should also be prepared to briefly explain and demonstrate extra features.
