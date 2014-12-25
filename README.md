PHPsa
=====

[![Project Status: Abandoned - Initial development has started, but there has not yet been a stable, usable release; the project has been abandoned and the author(s) do not intend on continuing development.](http://www.repostatus.org/badges/0.1.0/abandoned.svg)](http://www.repostatus.org/#abandoned)

This is really the skeleton of a defunct project from a few years ago. In
retrospect, PHP was almost certainly the wrong language to use for this
(compared to pretty much any modern web language, but especially because of
its scoping issues). I'm leaving it here only to pay homage to the idea of it,
which still might have some usefulness.

So, here's the original description and some of the notes. Full information
can currently be found on my [PHPsa Project Announcement Blog
Post](http://blog.jasonantman.com/2009/09/project-announcement-phpsa/).

 I’m calling it PHPsa for now, and it’s going to (hopefully) be an integrated
 dashboard/portal for SysAdmins. While there are a number of tools that fit
 into this general category (perhaps with
 [OSSIM](http://www.alienvault.com/home.php?section=News) being the closest,
 though it’s security-minded), I feel that there’s a real gap in terms of tool
 integration. My daily workflow, which includes multiple trips to and
 correlation among Nagios, Cacti, DNS, DHCP, Puppet, logs, and other tools
 really leaves something to be desired. So, I’m setting out to create a
 modular SysAdmin dashboard that unifies many of the common SysAdmin-related
 tools into a modular dashboard.

The first overall design goals that I’ve set are:

1.  A modular, plugin-based architecture that allows admins to select which
features/tools they want, and allows easy development of new modules.
2.  Design with legacy tools in mind – easy ways to tie in to tools that
weren’t written with PHPsa in mind, both in terms of linking to information
and gathering/unifying information.
3.  RBAC, including per-module rules and the possibility for a limited
read-only view (client/user mode).
4.  Use of data sources, specifically web-based/REST APIs where available, and
databases otherwise, from existing tools with as little modification as
possible.
5.  Support for database abstraction, though I’ll be using MySQL.
6.  Eventually, implement RSS feeds of pertinent information.
7.  Balance Ajax/DHTML with the desire for important things to have canonical,
static, bookmark-able URLs.

So, here are some of the things that I’m planning on integrating, with obvious
bias towards getting my own projects done before I integrate pre-existing
tools:

*   [MultiBindAdmin](http://multibindadmin.jasonantman.com), my DNS and DHCP administration tool (specifically
    geared towards split-view DNS with the inside view behind NAT).
*   [RackMan](http://rackman.jasonantman.com/), my tool for mapping devices’ physical locations in racks
    (and tacking patching).
*   My simple config tool for [Puppet](http://reductivelabs.com/products/puppet/).
*   [Nagios](http://nagios.org/).
*   [Cacti](http://www.cacti.net/).
*   Nathan Hubbard’s [MachDB](http://www.machdb.org/).
*   [Bacula](http://www.bacula.org/en/) (monitoring/status only).
*   Syslog via [rsyslog](http://www.rsyslog.com/) (or any other syslog-to-SQL solution).
*   Possibly a front-end to [Google Analytics](http://www.google.com/analytics/).
*   Some of my custom scripts for graphing SpamAssassin, DNS queries, etc.
*   Some sort of Apache log analysis, like [Webalizer](http://www.mrunix.net/webalizer/).
*   Mail log analysis, possibly [AWstats](http://awstats.sourceforge.net/).

INSTALLATION:
- Make sure the config_cache directory is writable by the web server.

//
// +----------------------------------------------------------------------+
// | PHPsa                        http://phpsa.jasonantman.com            |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Jason Antman.                                     |
// |                                                                      |
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License as published by |
// | the Free Software Foundation; either version 3 of the License, or    |
// | (at your option) any later version.                                  |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to:                           |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// |Please use the above URL for bug reports and feature/support requests.|
// +----------------------------------------------------------------------+
// | Authors: Jason Antman <jason@jasonantman.com>                        |
// +----------------------------------------------------------------------+
