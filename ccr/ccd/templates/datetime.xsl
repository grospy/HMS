<?xml version="1.0" encoding="UTF-8"?>
<!--
Conversion of CCR to Level 3 CCD

Orginal Author:   	Ken Miller
Solventus LLC
ken.miller@solventus.coms

-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:a="urn:astm-org:CCR" xmlns:date="http://exslt.org/dates-and-times" exclude-result-prefixes="a date">
	<!-- Displays the DateTime.  If ExactDateTime is present, it will format according
		 to the 'fmt' variable. The default format is: Oct 31, 2005 -->
  <xsl:import href="../lib/date.format-date.template.xsl"/>  
  <xsl:template name="dateTime" match="a:DateTime">
		<xsl:param name="dt" select="."/>
		<xsl:param name="fmt">MMM dd, yyyy</xsl:param>
    <xsl:for-each select="$dt">
      <tr>
        <xsl:if test="$dt/a:Type/a:Text">
          <td>
            <xsl:value-of select="a:Type/a:Text"/>:
          </td>
        </xsl:if>
        <xsl:choose>
          <xsl:when test="a:ExactDateTime">
            <td>
              <xsl:call-template name="date:format-date">
                <xsl:with-param name="date-time">
                  <xsl:value-of select="a:ExactDateTime"/>
                </xsl:with-param>
                <xsl:with-param name="pattern" select="$fmt"/>
              </xsl:call-template>
            </td>
          </xsl:when>
          <xsl:when test="$dt/a:Age">
            <td>
              <xsl:value-of select="$dt/a:Age/a:Value"/>
              <xsl:text xml:space="preserve"> </xsl:text>
              <xsl:value-of select="$dt/a:Age/a:Units/a:Unit"/>
            </td>
          </xsl:when>
          <xsl:when test="$dt/a:ApproximateDateTime">
            <td>
              <xsl:value-of select="$dt/a:ApproximateDateTime/a:Text"/>
            </td>
          </xsl:when>
          <xsl:when test="$dt/a:DateTimeRange">
            <td>
              <xsl:for-each select="$dt/a:DateTimeRange/a:BeginRange">
                <xsl:choose>
                  <xsl:when test="$dt/a:ExactDateTime">
                    <xsl:call-template name="date:format-date">
                      <xsl:with-param name="date-time">
                        <xsl:value-of select="$dt/a:ExactDateTime"/>
                      </xsl:with-param>
                      <xsl:with-param name="pattern" select="$fmt"/>
                    </xsl:call-template>
                  </xsl:when>
                  <xsl:when test="$dt/a:Age">
                    <xsl:value-of select="$dt/a:Age/a:Value"/>
                    <xsl:text xml:space="preserve"> </xsl:text>
                    <xsl:value-of select="$dt/a:Age/a:Units/a:Unit"/>
                  </xsl:when>
                  <xsl:when test="$dt/a:ApproximateDateTime">
                    <xsl:value-of select="$dt/a:ApproximateDateTime/a:Text"/>
                  </xsl:when>
                  <xsl:otherwise/>
                </xsl:choose>
              </xsl:for-each><xsl:text xml:space="preserve"> </xsl:text>
              -<xsl:text xml:space="preserve"> </xsl:text>
              <xsl:for-each select="$dt/a:DateTimeRange/a:EndRange">
                <xsl:choose>
                  <xsl:when test="$dt/a:ExactDateTime">
                    <xsl:call-template name="date:format-date">
                      <xsl:with-param name="date-time">
                        <xsl:value-of select="$dt/a:ExactDateTime"/>
                      </xsl:with-param>
                      <xsl:with-param name="pattern" select="$fmt"/>
                    </xsl:call-template>
                  </xsl:when>
                  <xsl:when test="$dt/a:Age">
                    <xsl:value-of select="$dt/a:Age/a:Value"/>
                    <xsl:text xml:space="preserve"> </xsl:text>
                    <xsl:value-of select="$dt/a:Age/a:Units/a:Unit"/>
                  </xsl:when>
                  <xsl:when test="$dt/a:ApproximateDateTime">
                    <xsl:value-of select="$dt/a:ApproximateDateTime/a:Text"/>
                  </xsl:when>
                  <xsl:otherwise/>
                </xsl:choose>
              </xsl:for-each>
            </td>
          </xsl:when>
          <xsl:otherwise/>
        </xsl:choose>
      </tr>
    </xsl:for-each>
	</xsl:template>
</xsl:stylesheet>
