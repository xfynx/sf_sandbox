
-----------------------------------------------------------------------------
-- blog_post
-----------------------------------------------------------------------------

DROP TABLE [blog_post];


CREATE TABLE [blog_post]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[title] VARCHAR(255)  NOT NULL,
	[excerpt] MEDIUMTEXT,
	[body] MEDIUMTEXT,
	[created_at] TIMESTAMP
);

-----------------------------------------------------------------------------
-- blog_comment
-----------------------------------------------------------------------------

DROP TABLE [blog_comment];


CREATE TABLE [blog_comment]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[blog_post_id] INTEGER,
	[author] VARCHAR(255),
	[email] VARCHAR(255),
	[body] MEDIUMTEXT,
	[created_at] TIMESTAMP
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([blog_post_id]) REFERENCES blog_post ([id])
