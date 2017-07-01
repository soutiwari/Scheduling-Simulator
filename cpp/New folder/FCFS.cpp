#include<bits/stdc++.h>
using namespace std;
struct process
{
    int arrival,pno,execution;
    int start;
    int end;
};
int main(int arg,char* argv[])
{
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
        //cout<<filename;
    }
    else{
        cout<<"No Input";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);

    int n;
    file>>n;

    process p[n];
    for(int i=0;i<n;i++)
    {
        p[i].pno = i+1;
        file>>p[i].arrival;
        file>>p[i].execution;
        //cin>>p[i].pno>>p[i].arrival>>p[i].execution;
    }
    p[0].start=p[0].arrival;
    p[0].end = p[0].arrival+p[0].execution;
    //cout<<p[0].start<<" "<<p[0].end<<endl;
    int clock=p[0].end;
    for(int i=1;i<n;i++)
    {
        if(clock<p[i].arrival)
        {
            clock=p[i].arrival;
        }
        p[i].start=clock;
        p[i].end=clock+p[i].execution;
        clock=p[i].end;
    }
    /*for(int i=0;i<n;i++)
    {
        cout<<p[i].pno<<" "<<p[i].start<<" "<<p[i].end<<endl;
    }*/
char time_clock[n+1][clock+1];
    for(int i=0;i<n;i++)
    {
        //cout<<p[i].pno<<endl;
        if(i==0)
        {
            for(int j=0;j<p[i].start;j++)
                time_clock[p[i].pno][j]='_';
            for(int j=p[i].start;j<p[i].end;j++)
                time_clock[p[i].pno][j]='*';
            for(int j=p[i].end;j<=clock;j++)
                time_clock[p[i].pno][j]='_';
           if(time_clock[p[i].pno][p[i].arrival]=='_')
            time_clock[p[i].pno][p[i].arrival]='|';
            else
            time_clock[p[i].pno][p[i].arrival]='#';
        }
        else
        {
            for(int j=0;j<=p[i].start;j++)
                time_clock[p[i].pno][j]='_';
            for(int j=p[i].start;j<p[i].end;j++)
                time_clock[p[i].pno][j]='*';
            for(int j=p[i].end;j<=clock;j++)
                time_clock[p[i].pno][j]='_';
                //cout<<p[i].arrival<<endl;
            if(time_clock[p[i].pno][p[i].arrival]=='_')
            time_clock[p[i].pno][p[i].arrival]='|';
            else
            time_clock[p[i].pno][p[i].arrival]='#';
        }
    }
    for(int i=1;i<=n;i++)
    {
        for(int j=0;j<=clock;j++)
            cout<<time_clock[i][j];
        cout<<endl;
    }
    int response[n+1];
    for(int i=0;i<n;i++)
    {
        response[p[i].pno]=p[i].end-p[i].arrival;
    }
    for(int i=1;i<=n;i++)
    {
        cout<<"Response time for process-"<<i<<" :"<<response[i]<<endl;
    }
    return 0;
}
