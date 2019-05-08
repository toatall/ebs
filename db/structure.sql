
-- add table EBS_FILES

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[EBS_FILES](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[guid] [varchar](8) NOT NULL,
	[filename] [varchar](500) NOT NULL,
	[inn] [varchar](12) NULL,
	[status_np] [int] NULL,
	[description] [text] NULL,
	[date_add] [datetime] NULL,
	[sono] [varchar](4) NULL,
 CONSTRAINT [PK_EBS_FILES] PRIMARY KEY CLUSTERED 
(
	[guid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[EBS_FILES] ADD  CONSTRAINT [DF_EBS_FILES_date_add]  DEFAULT (getdate()) FOR [date_add]
GO


-- add table EBS_FILES_LOG

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[EBS_FILES_LOG](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[file_id] [int] NOT NULL,
	[date_add] [datetime] NULL,
	[user_ip] [varchar](20) NOT NULL,
	[user_browser_agent] [varchar](250) NULL,
	[user_browser_name] [varchar](250) NULL,
	[user_browser_version] [varchar](250) NULL,
	[user_browser_platform] [varchar](250) NULL,
 CONSTRAINT [PK_EBS_FILES_LOG] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[EBS_FILES_LOG] ADD  CONSTRAINT [DF_EBS_FILES_LOG_date_add]  DEFAULT (getdate()) FOR [date_add]
GO


