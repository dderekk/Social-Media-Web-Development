PRAGMA foreign_keys = ON;

-- for table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `UsersID` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `Name` TEXT
);


-- for table `post`
CREATE TABLE IF NOT EXISTS `post` (
  `POSTID` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `Title` TEXT,
  `Message` TEXT,
  `Post_Date` DATE,
  `Update_Date` DATE,
  `AuthorID` INTEGER,
  FOREIGN KEY (`AuthorID`) REFERENCES `users` (`UsersID`)
);

-- for table `comments`
CREATE TABLE IF NOT EXISTS `comments` (
  `CommentID` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  `Message` TEXT,
  `Comment_Date` DATE,
  `UsersID` INTEGER,
  `AppliedID` INTEGER,
  `BelongPostID` INTEGER,
  FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`),
  FOREIGN KEY (`AppliedID`) REFERENCES `comments` (`CommentID`),
  FOREIGN KEY (`BelongPostID`) REFERENCES `post` (`POSTID`)
);

-- for table `likes`
CREATE TABLE IF NOT EXISTS `likes` (
  `UsersID` INTEGER,
  `POSTID` INTEGER,
  `State` INTEGER,
  PRIMARY KEY (`UsersID`, `POSTID`),
  FOREIGN KEY (`UsersID`) REFERENCES `users` (`UsersID`),
  FOREIGN KEY (`POSTID`) REFERENCES `post` (`POSTID`)
);

-- Insert data into table `users`
INSERT INTO `users` (`UsersID`, `Name`) VALUES
(1, 'JAMES'),
(2, 'Josephine'),
(3, 'Maeve'),
(4, 'Isla'),
(5, 'Freya'),
(6, 'Hugo'),
(7, 'Soren'),
(8, 'Silas'),
(9, 'Milo'),
(10, 'Sebastian'),
(11, 'Oscar');


-- Insert data into table `post`
INSERT INTO `post` (`POSTID`, `Title`, `Message`, `Post_Date`,`Update_Date`, `AuthorID`) VALUES
(1, 'For a More Creative Brain Foll to improve his eating habits', 'Changing the Cues nAnother way you can change a habit is by identifying and altering the cues that prompt your behavior. This is precisely what many readers have done.One woman named Lisa cultivated a reading habit by increasing her exposure to books. “I’ve read more books by continually having 20-30 books on hold at the library,” she said. “It saves time on browsing for books. I always have new things to read with a three-week deadline.”nHeather used a similar strategy to reinforce the simple habit of drinking more water. “I use color and placement for visual reminding and motivation. I poured water in a bright aqua water bottle – my favorite color – and placed it on my nightstand so I couldn’t miss it when I woke up.”\r\n\r\nOther readers have done the opposite. They reduced exposure to negative cues. One man named Max managed to eliminate his e-cigarette habit. “I quit e-cigarettes with a combination of determination and also quitting coffee at the same time, which was a trigger for me as I’d smoke and drink coffee together in the morning.”\nHabit Stacking nAnother popular tactic in the book is something I call “habit stacking.” It’s strategy I first learned from Stanford professor B.J. Fogg. He refers to it as “anchoring” because you anchor—or stack—your new habit onto a current habit.\r\n\r\nOne reader used habit stacking to create a simple rule for learning a new language. When I first moved to China and started to learn Mandarin, I committed to strike up a conversation with the taxi driver whenever I went into a cab (I took a lot of cab rides, 5+ daily). I did it for 2 years no matter the time of day or how tired I was. I now speak fluent Chinese.”\r\n\r\nSimilarly, a reader named David told me, “I meditate for 20 minutes after brushing my teeth in the morning. Linking new habits onto a keystone one seems to work.” You’ll find all sorts of habit stacking examples in Chapter 5 of Atomic Habits.', '2023-08-02',NULL, 1),
(2, 'The Ultimate Productivity Hack on How to Build Confidence', 'Garry Kasparov and his long-time rival Anatoly Karpov—two of the greatest chess players of all-time—took their respective seats around the chess board. The 1990 World Chess Championship was about to begin.\The two men would play 24 games to decide the champion with the highest scoring player being declared the World Chess Champion. In total, the match would stretch for three months with the first 12 games taking place in New York and the final 12 games being played in Lyon, France.nKasparov started off well, but soon began to make mistakes. He lost the seventh game and let multiple victories slip away during the first half of the tournament. After the first 12 games, the two men left New York with the match tied at 6-6. The New York Times reported that “Mr. Kasparov had lost confidence and grown nervous in New York.”\ If Kasparov was going to retain his title as the best in the world, it was going to take everything he had.“Playing Kasparov Chess”\r\nJosh Waitzkin was a chess prodigy as a child and won multiple U.S. Junior Championships before the age of 10. Along the way, Waitzkin and his father had the opportunity to connect with Garry Kasparov and discuss chess strategy with him. In particular, they learned how Kasparov dealt with remarkably difficult matches like the one he faced against Karpov in the 1990 World Chess Championship.\r\n\r\nWaitzkin shares the story in his book, The Art of Learning (audiobook).nKasparov was a fiercely aggressive chess player who thrived on energy and confidence. My father wrote a book called Mortal Games about Garry, and during the years surrounding the 1990 Kasparov-Karpov match, we both spent quite a lot of time with him.\r\n\r\nAt one point, after Kasparov had lost a big game and was feeling dark and fragile, my father asked Garry how he would handle his lack of confidence in the next game. Garry responded that he would try to play the chess moves that he would have played if he were feeling confident. He would pretend to feel confident, and hopefully trigger the state.\r\n\r\nKasparov was an intimidator over the board. Everyone in the chess world was afraid of Garry and he fed on that reality. If Garry bristled at the chessboard, opponents would wither. So if Garry was feeling bad, but puffed up his chest, made aggressive moves, and appeared to be the manifestation of Confidence itself, then opponents would become unsettled. Step by step, Garry would feed off his own chess moves, off the created position, and off his opponent’s building fear, until soon enough the confidence would become real and Garry would be in flow… He was not being artificial. Garry was triggering his zone by playing Kasparov chess.—Josh Waitzkin, The Art of Learning', '2023-08-04',NULL, 2),
(3, 'Learning the Art of A Pig', 'To deepen his understanding of Japanese culture, Herrigel began training in Kyudo, the Japanese martial art of archery. He was taught by a legendary archer named Awa Kenzo. Kenzo was convinced that be anything.', '2023-08-08',NULL, 4),
(4, 'Retain More of Every Book You Read', 'Elite performers will often measure, quantify, and track their progress in various ways. Each little measurement provides feedback. It offers a signal of whether they are making progress or need to change course.nGabrielle Hamilton, a chef in New York City, provides a good example. During an interview with the New York Times, she said, “The one thing I see that consistently separates the chef from the home cook is that we taste everything, all the time, before we commit it to the dish, right down to the grains of salt. We slurp shot glasses of olive oil and aerate them in our mouths as if it were a wine we were trying to know. We taste the lamb, the fish, the butter, the milk before we use it… we chew salt to see how we like it in our teeth, on our tongues, and to know its flavor, its salinity.” For the chef, tasting the ingredients tells them whether they are making progress toward their desired end goal. It provides the immediate feedback they need to get the recipe just right.nLike a chef improving a recipe through trial and error, we often improve our habits through trial and error. If one approach doesn’t deliver the desired effect, then we adjust—like a chef tweaking the amount of an ingredient. nHowever, there is an important difference between getting feedback while cooking a meal and getting feedback while building a habit. When it comes to building a habit, feedback is often delayed. It’s easy to taste an ingredient or to watch bread rise in the oven. But it can be difficult to visualize the progress you are making with your habits. Perhaps you’ve been running for a month, but you still don’t see a change in your body. Or maybe you managed to meditate for 16 straight days, but you still feel stressed and anxious at work.\r\n\r\nHabit formation is a long race. It often takes time for the desired results to appear. And while you are waiting for the long-term rewards of your efforts to accumulate, you need a reason to stick with it in the short-term. You need some immediate feedback that shows you are on the right path.\r\n\r\nAnd this is where a habit tracker can help.\r\nThe Habit Tracker: What It Is and How It Works\r\nA habit tracker is a simple way to measure whether you did a habit.\r\n\r\nThe most basic format is to get a calendar and cross off each day you stick with your routine. For example, if you meditate on Monday, Wednesday, and Friday, each of those dates gets an X. As time rolls by, the calendar becomes a record of your habit streak.', '2023-08-10',NULL, 5),
(5, 'The Ultimate Habit Tracker Gui', 'Here’s why:lite performers will often measure, quantify, and track their progress in various ways. Each little measurement provides feedback. It offers a signal of whether they are making progres', '2023-08-11','2023-08-16', 6),
(6, "The Proven Path to Doing Uniqu", "Here iss why: Elite performers will often measure, quantify, and track their progress in various ways. Each little measurement provides feedback. It offers a signal of whether they are making progress or need to change course.Gabrielle Hamilton, a chef in New York City, provides a good example. During an interview with the New York Times, she said, “The one thing I see that consistently separates the chef from the home cook is that we taste everything, all the time, before we commit it to the dish, right down to the grains of salt. We slurp shot glasses of olive oil and aerate them in our mouths as if it were a wine we were trying to know. We taste the lamb, the fish, the butter, the milk before we use it… we chew salt to see how we like it in our teeth, on our tongues, and to know its flavor, its salinity.” For the chef, tasting the ingredients tells them whether they are making progress toward their desired end goal. It provides the immediate feedback they need to get the recipe just right.\rLike a chef improving a recipe through trial and error, we often improve our habits through trial and error. If one approach doesn’t deliver the desired effect, then we adjust—like a chef tweaking the amount of an ingredient.nHowever, there is an important difference between getting feedback while cooking a meal and getting feedback while building a habit. When it comes to building a habit, feedback is often delayed. It’s easy to taste an ingredient or to watch bread rise in the oven. But it can be difficult to visualize the progress you are making with your habits. Perhaps you’ve been running for a month, but you still don’t see a change in your body. Or maybe you managed to meditate for 16 straight days, but you still feel stressed and anxious at work.", '2023-08-15', NULL, 1),
(7, 'The Ultimate somebody good', 'Here’s why: nElite performers will often measure, quantify, and track their progress in various ways. Each little measurement provides feedback. It offers a signal of whether they are making progres', '2023-08-19','2023-08-26', 4),
(8, 'The Master of Habit Tracker The Ultimate Productivity Hack on How to Build Confidence NVC', "Htify, The National Broadcasting Company[a] (NBC) is an American English-language commercial broadcast television and radio network. The flagship property of the NBC Entertainment division of NBCUniversal, a subsidiary of Comcast, its headquarters are located at Comcast Building in New York City. The company also has offices in Los Angeles at 10 Universal City Plaza and Chicago at the NBC Tower. NBC is the oldest of the traditional American television networks, having been formed in 1926 by the Radio Corporation of America. NBC is sometimes referred to  the Peacock Network, in reference to its stylized peacock logo, introduced in 1956 to promote the company's innovations in early color broadcasting, measurement provides feedback. It offers a signal of whether they are making progres", '2023-08-20','2023-08-21', 3);
-- Insert data into table `comments`
INSERT INTO `comments` (`CommentID`, `Message`, `Comment_Date`, `UsersID`, `AppliedID`, `BelongPostID`) VALUES
(1, 'This is really fun article, good job', '2023-08-05', 2, NULL, 1),
(2, 'Users can edit posts. Only the title and message can be edited. Date should be automatically\r\nupdated. After a post is edited, the details page for that post is displayed.', '2023-08-6', 8, NULL, 3),
(3, 'Now you put water into a cup, it becomes the cup; you put it into a botttle, it becomes the bottle; you put it into a teapot, it becomes the teapot. Water can flow, or it can crash. Be water, my friend.', '2023-08-05', 5, NULL, 1),
(4, 'I pretty much like any food made from carrots.', '2023-08-07', 10, NULL, 1),
(5, 'Thank you!', '2023-08-08', 1, 1, 1),
(6, 'do somebody good and be good for somebody', '2023-08-09', 7, 5, 1),
(7, 'Some people call me a hero.Their word,not mine. But it does have a nice ring to it.', '2023-08-010', 11, NULL, 3);

-- Insert data into table `likes`
INSERT INTO `likes` (`UsersID`, `POSTID`, `State`) VALUES
(1, 5, 1),
(2, 2, 1),
(1, 3, 1),
(3, 5, 1),
(1, 4, 1),
(5, 6, 1),
(7, 1, 1),
(2, 1, 1),
(6, 1, 1);




PRAGMA foreign_keys = OFF;
