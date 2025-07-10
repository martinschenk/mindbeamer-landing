<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xhtml="http://www.w3.org/1999/xhtml"
                xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>MindBeamer.io - XML Sitemap</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <style type="text/css">
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                        color: #333;
                        background-color: #f5f5f5;
                        margin: 0;
                        padding: 0;
                        line-height: 1.6;
                    }
                    
                    .container {
                        max-width: 1200px;
                        margin: 0 auto;
                        background: white;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    
                    header {
                        background: linear-gradient(135deg, #EC4899 0%, #8B5CF6 50%, #14B8A6 100%);
                        color: white;
                        padding: 2rem;
                        text-align: center;
                    }
                    
                    header h1 {
                        margin: 0;
                        font-size: 2rem;
                        font-weight: 600;
                    }
                    
                    header p {
                        margin: 0.5rem 0 0;
                        opacity: 0.9;
                    }
                    
                    .info {
                        padding: 2rem;
                        background: #f8f9fa;
                        border-bottom: 1px solid #e9ecef;
                    }
                    
                    .info p {
                        margin: 0;
                        color: #666;
                    }
                    
                    .info strong {
                        color: #333;
                    }
                    
                    .content {
                        padding: 2rem;
                    }
                    
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 1rem;
                    }
                    
                    th {
                        background: #f8f9fa;
                        padding: 1rem;
                        text-align: left;
                        font-weight: 600;
                        color: #333;
                        border-bottom: 2px solid #dee2e6;
                    }
                    
                    td {
                        padding: 0.75rem 1rem;
                        border-bottom: 1px solid #e9ecef;
                    }
                    
                    tr:hover {
                        background: #f8f9fa;
                    }
                    
                    a {
                        color: #8B5CF6;
                        text-decoration: none;
                    }
                    
                    a:hover {
                        text-decoration: underline;
                    }
                    
                    .url-cell {
                        word-break: break-word;
                    }
                    
                    .priority {
                        text-align: center;
                    }
                    
                    .high-priority {
                        color: #28a745;
                        font-weight: 600;
                    }
                    
                    .medium-priority {
                        color: #ffc107;
                    }
                    
                    .low-priority {
                        color: #6c757d;
                    }
                    
                    .lastmod {
                        white-space: nowrap;
                    }
                    
                    .alternates {
                        font-size: 0.875rem;
                        color: #666;
                        margin-top: 0.25rem;
                    }
                    
                    .alternates span {
                        display: inline-block;
                        margin-right: 0.5rem;
                        padding: 0.125rem 0.5rem;
                        background: #e9ecef;
                        border-radius: 3px;
                    }
                    
                    .images {
                        font-size: 0.875rem;
                        color: #666;
                        margin-top: 0.25rem;
                    }
                    
                    .images-count {
                        display: inline-block;
                        padding: 0.125rem 0.5rem;
                        background: #d1ecf1;
                        color: #0c5460;
                        border-radius: 3px;
                    }
                    
                    footer {
                        padding: 2rem;
                        text-align: center;
                        color: #666;
                        background: #f8f9fa;
                        border-top: 1px solid #e9ecef;
                    }
                    
                    @media (max-width: 768px) {
                        table {
                            font-size: 0.875rem;
                        }
                        
                        th, td {
                            padding: 0.5rem;
                        }
                        
                        .alternates span {
                            display: block;
                            margin-bottom: 0.25rem;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <header>
                        <h1>MindBeamer.io XML Sitemap</h1>
                        <p>This sitemap contains all URLs for search engine indexing</p>
                    </header>
                    
                    <div class="info">
                        <p><strong>Total URLs:</strong> <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></p>
                    </div>
                    
                    <div class="content">
                        <table>
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Last Modified</th>
                                    <th>Change Frequency</th>
                                    <th>Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="sitemap:urlset/sitemap:url">
                                    <xsl:sort select="sitemap:priority" order="descending"/>
                                    <tr>
                                        <td class="url-cell">
                                            <a>
                                                <xsl:attribute name="href">
                                                    <xsl:value-of select="sitemap:loc"/>
                                                </xsl:attribute>
                                                <xsl:value-of select="sitemap:loc"/>
                                            </a>
                                            
                                            <!-- Show alternate languages if available -->
                                            <xsl:if test="xhtml:link[@rel='alternate']">
                                                <div class="alternates">
                                                    <xsl:for-each select="xhtml:link[@rel='alternate']">
                                                        <span>
                                                            <xsl:value-of select="@hreflang"/>
                                                        </span>
                                                    </xsl:for-each>
                                                </div>
                                            </xsl:if>
                                            
                                            <!-- Show image count if available -->
                                            <xsl:if test="image:image">
                                                <div class="images">
                                                    <span class="images-count">
                                                        <xsl:value-of select="count(image:image)"/> image<xsl:if test="count(image:image) > 1">s</xsl:if>
                                                    </span>
                                                </div>
                                            </xsl:if>
                                        </td>
                                        <td class="lastmod">
                                            <xsl:value-of select="substring(sitemap:lastmod, 1, 10)"/>
                                        </td>
                                        <td>
                                            <xsl:value-of select="sitemap:changefreq"/>
                                        </td>
                                        <td class="priority">
                                            <xsl:choose>
                                                <xsl:when test="sitemap:priority >= 0.8">
                                                    <span class="high-priority">
                                                        <xsl:value-of select="sitemap:priority"/>
                                                    </span>
                                                </xsl:when>
                                                <xsl:when test="sitemap:priority >= 0.5">
                                                    <span class="medium-priority">
                                                        <xsl:value-of select="sitemap:priority"/>
                                                    </span>
                                                </xsl:when>
                                                <xsl:otherwise>
                                                    <span class="low-priority">
                                                        <xsl:value-of select="sitemap:priority"/>
                                                    </span>
                                                </xsl:otherwise>
                                            </xsl:choose>
                                        </td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </div>
                    
                    <footer>
                        <p>This XML Sitemap is styled for human readability. Search engines read the underlying XML structure.</p>
                    </footer>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>